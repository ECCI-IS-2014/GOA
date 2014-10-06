<h1>Add your Post <strong>Baby!</strong></h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Post (Hope u checked ur spelling xD)');
?>
