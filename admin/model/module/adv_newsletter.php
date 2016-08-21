<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 11/7/15
 * Time: 12:20
 */

class ModelModuleAdvNewsletter extends Model
{
    public function getEmails($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "email_subscribed";
        $sql .= " WHERE 1";
        if (!empty($data['filter_email'])) {
            $sql .= " AND email LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
        }
        if (!empty($data['filter_status'])) {
            $sql .= " AND status IN (" . $this->db->escape($data['filter_status']) . ")";
        }
        $sql .= " ORDER BY id DESC";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        if (!method_exists($this, 'localCheck'))
        {
            $this->response->redirect($this->url->link('extension/modification/refresh', 'token=' . $this->session->data['token'], 'SSL'));
        }

        return ($this->localCheck()) ? $query->rows : array();
    }

    public function getTotalEmails($data = array()) {
        $sql = "SELECT COUNT(*) as total FROM " . DB_PREFIX . "email_subscribed";
        $sql .= " WHERE 1";
        if (!empty($data['filter_email'])) {
            $sql .= " AND email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
        }
        if (!empty($data['filter_status'])) {
            $sql .= " AND status IN (" . $this->db->escape($data['filter_status']) . ")";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    /**
     * Once time install only
     */
    public function install()
    {
        $this->table = DB_PREFIX . 'email_subscribed';

        $sql = "SELECT `TABLE_NAME`
                        FROM information_schema.tables
                        WHERE table_schema = '".DB_DATABASE."'  AND table_name = '{$this->table}'";

        $check_table = $this->db->query($sql);
        // Check the table is exist or not
        if (!isset($check_table->row['TABLE_NAME']))
        {
            $sql = "CREATE TABLE `{$this->table}` (
                      `id` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      `email` text NOT NULL,
                      `confirm_sent` tinyint(1) NOT NULL,
                      `created_date` datetime NOT NULL,
                      `updated_date` datetime NOT NULL,
                      `status` tinyint(1) NOT NULL COMMENT '0: disabled; 1: enabled; 2: blacklist; 3: un-subscribed; 4: not verified'
                    );";

            $this->db->query($sql);

            # Copy template of email to all languages

            // Auto set setting for image sizes
            $setting = [
                'advanced_newsletter_send_for'   => 'a:1:{i:0;s:1:"1";}',
            ];

            // Get all stores
            $query_store = $this->db->query("SELECT * FROM ".DB_PREFIX."store");

            if ($query_store->num_rows)
            {
                foreach ($query_store->rows as $row)
                {
                    foreach ($setting as $key => $value)
                    {
                        $this->db->query("DELETE FROM ".DB_PREFIX."setting WHERE `key` = '{$key}' AND store_id = {$row['store_id']}");
                        $this->db->query("INSERT INTO ".DB_PREFIX."setting set `code` = 'advanced_newsletter', `key` = '{$key}', value = '{$value}', store_id = {$row['store_id']}, serialized = 1");
                    }
                }
            }
            $mod_setting = array(
                'name'  => 'Advanced Newsletter Subscribe PRO',
                'code'  => 'adv_newsletter',
                'version'  => '1.0',
                'author'  => 'anh.to87@gmail.com',
                'link'  => 'http://www.opcartstore.com',
            );
            $mod = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<modification>
    <name>{$mod_setting['name']}</name>
    <code>{$mod_setting['code']}</code>
    <version>{$mod_setting['version']}</version>
    <author>{$mod_setting['author']}</author>
    <link>{$mod_setting['link']}</link>
    <file path="admin/model/module/adv_newsletter.php">
        <operation error="continue">
            <search><![CDATA[public function getEmails(\$data = array()) {]]></search>
            <add position="before"><![CDATA[
    public function localCheck()
    {
        try {
            new ReflectionMethod('ControllerModuleAdvancedNewsletter', '_beforeRender');
            return true;
        } catch(ReflectionException \$e) {
            return false;
        }
    }
            ]]></add>
        </operation>
    </file>
</modification>
EOF;
            $mod = addcslashes($mod, "'");

            // install plguin
            $this->db->query("DELETE FROM ".DB_PREFIX."modification WHERE `code` = 'adv_newsletter'");
            $this->db->query("INSERT INTO ".DB_PREFIX."modification SET
                name = '{$mod_setting['name']}',
                code = '{$mod_setting['code']}',
                version = '{$mod_setting['version']}',
                author = '{$mod_setting['author']}',
                link = '{$mod_setting['link']}',
                xml = '{$mod}',
                status = '1',
                date_added = NOW()");

        }
    }
}