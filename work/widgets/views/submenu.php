<style>
    .submenu{
        position: absolute;
        width: 100%;
        left: 0px;
        top: 80px;

    }
</style>
<div class="submenu">
    <ul class="pull-left">
        <?php if($left){ foreach($left as $k=>$el){ if(is_array($el)){ ?>
            
            <li><a href="<?=$el["href"]?>" class="<?=$el["class"]?>" <?=(isset($el["target"])?"target='".$el["target"]."'":"")?>><?=$k?></a></li>
        <?php }else echo "<li>".$el."</li>"; } }?>
    </ul>
    <ul class="pull-right">
        <?php if($right){ foreach($right as $k=>$el){ ?>
            <li><a href="<?=$el["href"]?>" class="<?=(isset($el["class"])?$el["class"]:"")?>"><?=$k?></a></li>
        <?php }} ?>
    </ul>
</div>
