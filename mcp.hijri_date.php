<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hijri_date_mcp {

    /**
     * Constructor
     *
     * @access    public
     */
    function __construct()
    {
        // Make a local reference to the ExpressionEngine super object
        $this->EE =& get_instance();
        // $this->index();
        
    }

    // --------------------------------------------------------------------

    /**
     * Main Page
     *
     * @access    public
     */
    function index()
    {
        $this->EE->load->library('javascript');
        $this->EE->load->library('table');
        $this->EE->load->helper('form');

        $ajax_method="adjust_date";
        $m=str_replace("amp;","",BASE);
        $this->EE->javascript->output(array(
'var button;

$("#date").ajaxError(function(event, request, settings) {
  //alert( "Triggered ajaxError handler." );
});

$("#date").ajaxComplete(function(event, req, ajaxOptions)  {
    if(req.statusText="OK")  
    {
        $("#date").html(req.response); 
        button.removeAttr("disabled");
    }
});

function adjust_date(value)
{ 
sSource="'.$m.'&C=addons_modules&M=show_module_cp&module=hijri_date&method='.$ajax_method.'";
         
$.getJSON( sSource,
            {    
                value: value
            },
            function(result) 
            {             
                alert(result);
            }
        ); 
}

$("#plus").click(function(){
    button=$("#plus");
    button.attr("disabled",true);
    adjust_date(1);
});              

$("#minus").click(function(){
    button=$("#minus");
    button.attr("disabled",true);
    adjust_date(-1);
});

$("#reset").click(function(){
    button=$("#reset");
    button.attr("disabled",true);
    adjust_date(0);
});              

'            )
        );
            
        $this->EE->javascript->compile();
        
        $this->EE->cp->set_variable('cp_page_title', $this->EE->lang->line('hijri_date_module_name'));

        $vars['action_url'] = 'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=hijri_date'.AMP.'method=adjust_date';
        $vars['form_hidden'] = NULL;
        
        return $this->EE->load->view('index', $vars, TRUE);
    }
    

    function adjust_date()
    {   
      exit($this->EE->load->view('ajax_date',null,TRUE));
    }

    
    
}
// END CLASS

/* End of file mcp.hijri_date.php */
/* Location: ./system/expressionengine/third_party/modules/download/mcp.download.php */