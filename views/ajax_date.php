<?php
      $value = $this->EE->input->get_post('value');          
      $content=file_get_contents(PATH_THIRD."hijri_date/uCal.class.php");
      
      preg_match("/var \\\$adjustment_value=([-0-9]{1,});/",$content,$match);
      $prev_value=$match[1];
      
      if($value!=0)
        $value=$value+$prev_value;
      
      $content=str_replace("var \$adjustment_value=".($prev_value).";","var \$adjustment_value=$value;",$content);
      $f=fopen(PATH_THIRD."hijri_date/uCal.class.php",'w');
      fwrite($f,$content);
      fclose($f);
      
      include PATH_THIRD.'hijri_date/uCal.class.php';
      $d=new uCal;
      $d->setLang('ar');
      echo $hijri_date=$d->date("l j F Y");

    

  
?>