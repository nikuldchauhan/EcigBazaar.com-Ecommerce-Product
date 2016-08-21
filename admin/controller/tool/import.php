<?php 
class ControllerToolImport extends Controller { 
	
	public function index() {
		
	$this->load->model("tool/import");
		
		$this->document->setTitle("Customers Import Tool");
		$this->data['heading_title'] = "Customer Import Tool";
		$this->data['entry_restore'] = $this->language->get('entry_restore');
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => "home",
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => FALSE
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => "Customer Imports",
			'href'      => $this->url->link('tool/import', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			if ((isset( $this->request->files['upload'] )) && (is_uploaded_file($this->request->files['upload']['tmp_name']))) {
				$file = $this->request->files['upload']['tmp_name'];
				if ($this->model_tool_import->import($file)===TRUE) {
					$this->session->data['success'] = "You are successfully imported customers";
					$this->redirect($this->url->link('tool/import', 'token=' . $this->session->data['token'], 'SSL'));
				}
				else {
					$this->error['warning'] = "Sorry an Error occured";
				}
			}
		}
		
		
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
			
			//unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$this->data['action'] = $this->url->link('tool/import', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->template = 'tool/import.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);
		$this->response->setOutput($this->render());
		
	}
	
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'tool/import')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>