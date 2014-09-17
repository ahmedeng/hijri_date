<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hijri_date {

	var $return_data	= '';
	

	
	function __construct()
	{
		// Make a local reference to the ExpressionEngine super object
		$this->EE =& get_instance();

	}
	
	function date()
    {
    
        // fetch params
        $fmt_hj_ar = ($this->EE->TMPL->fetch_param('fmt_hj_ar')=='')? 'l j F Y':$this->EE->TMPL->fetch_param('fmt_hj_ar');
        $fmt_hj_en = ($this->EE->TMPL->fetch_param('fmt_hj_en')=='')? 'l j F Y' :$this->EE->TMPL->fetch_param('fmt_hj_en');
        $fmt_gr_ar = ($this->EE->TMPL->fetch_param('fmt_gr_ar')=='')? 'l j F Y':$this->EE->TMPL->fetch_param('fmt_gr_ar');
        $fmt_gr_en = ($this->EE->TMPL->fetch_param('fmt_gr_en')=='')? 'l j F Y' :$this->EE->TMPL->fetch_param('fmt_gr_en');
        $lang = ($this->EE->TMPL->fetch_param('lang')=='')? 'ar' :$this->EE->TMPL->fetch_param('lang');
        $date = $this->EE->TMPL->fetch_param('date');
        
        $this->EE->load->library('typography');
        $this->EE->typography->initialize();
        $this->EE->typography->parse_images = TRUE;
        $this->EE->typography->allow_headings = FALSE;
        
        
        
        require_once PATH_THIRD.'hijri_date/uCal.class.php';
        $d=new uCal;
        $d->setLang($lang);
        if($lang=='ar')
        {
            $fmt_ar=$fmt_hj_ar;
            $fmt_en=$fmt_gr_ar;
        }
        else
        {
            $fmt_ar=$fmt_hj_en;
            $fmt_en=$fmt_gr_en;
        }
        if($date=='')
        {
            $hijri_date=$d->date($fmt_ar);
            $gr_date=$d->date($fmt_en,0,0);
        }
        else
        {     
            $hijri_date=$d->date($fmt_ar,strtotime($date));
            $gr_date=$d->date($fmt_en,strtotime($date),0);
        }
        
        
        $variables[] = array(
            'hijri_date' => $hijri_date,
            'gr_date' => $gr_date
            );                                        

        $output = $this->EE->TMPL->parse_variables($this->EE->TMPL->tagdata, $variables); 
        
        return $output;
    }	
}

/* End of file mod.download.php */
/* Location: ./system/expressionengine/third_party/download/mod.download.php */