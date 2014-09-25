<div class='comment-form'>
    <form method="post">
        <input type="hidden" name="redirect" value="<?=$url?>" />
        <input type="hidden" name="commentId" value="<?=$id?>" />
        <fieldset>
            <legend>Edit a comment</legend>
            <textarea name='content'><?=$content?></textarea></label></p>
            <p><label>Name:<br/><input type='text' name='name' value='<?=$name?>'/></label></p>
            <p><label>Homepage:<br/><input type='text' name='web' value='<?=$web?>'/></label></p>
            <p><label>Email:<br/><input type='text' name='mail' value='<?=$mail?>'/></label></p>
            <p class=buttons>
                <input type='submit' name='doCreate' value='Edit' onClick="this.form.action = '<?=$this->url->create('comment/doEdit')?>'"/>
            </p>
            <output><?=$output?></output>
        </fieldset>
    </form>
</div>