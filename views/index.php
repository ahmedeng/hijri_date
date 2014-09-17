<?php
  include PATH_THIRD.'hijri_date/uCal.class.php';
  $d=new uCal;
  $d->setLang('ar');
  $hijri_date=$d->date("l j F Y");
?> 

<?=form_open($action_url, '', $form_hidden)?>

<?php                             
    $this->table->set_template($cp_table_template);
    $this->table->set_heading(
        array('data' => lang('Date Adjustment'),'style' => 'width:50;'),
        '',
        ''
        );

        $label_attributes = array('id' => 'date'    );
        $plus_attributes = array('id' => 'plus','name' => 'plus'  ,'content' => '+'  );
        $minus_attributes = array('id' => 'minus','name' => 'minus'  ,'content' => '-'  );
        $reset_attributes = array('id' => 'reset','name' => 'reset'  ,'content' => 'Reset'  );
        
        $this->table->add_row(
                form_label($hijri_date,'date',$label_attributes),
                form_button($plus_attributes).form_button($minus_attributes),
                form_button($reset_attributes)
            );

echo $this->table->generate();

?>
<div class="tableFooter">
    
</div>    

<?=form_close()?>

