<?php if(isset($chapter[0])){ ?>
    <label for="" class="control-label"><i>Chọn Chương</i></label>
    <div class="input-icon">
        <i class="fa fa-folder-open"></i>
        <select class="form-control" name="chapter_id">
            <?php foreach ($chapter as $key => $chap) { ?>
            <option value="<?php echo $chap['id']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $chap['name']; ?></option>
            <?php } ?>
        </select>
    </div>
<?php } ?>   