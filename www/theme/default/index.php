


    <div class="container">

        <div class="panel panel-info">
            <div class="panel-heading"><?php echo $this->pageContent['pageTitle']; ?></div>
            <div class="panel-body">
                <p><?php echo $this->pageContent['pageDescription']; ?></p>
            </div>

<?php if($this->pageContent['type'] == 'form') { ?>
<?php
/**
 * Code for converting array into an html form.
 */
?>




<?php } else { ?>
<?php
/**
 * Code for converting array into an html table.
 */
?>
        <table class="table table-hover table-striped">
            <tr>
                <th colspan="<?php echo count($this->pageContent['tableColumns']); ?>">
                    <a href="?module=<?php echo $this->curModule(); ?>&action=add" title="Add"><span class="glyphicon glyphicon-plus"></span> Add</a>
                </th>
            </tr>
            <tr>
<?php foreach($this->pageContent['tableColumns'] as $keyCols => $valueCols) { ?>
                <th><?php echo $valueCols; ?></th>
<?php } ?>
            </tr>
<?php foreach($this->pageContent['content'] as $keyCon => $valueCon) { ?>
            <tr>
<?php     foreach($valueCon as $keyConn => $valueConn) { ?>
                <td><?php echo $valueConn; ?></td>
<?php     } ?>
                <td>
                    <a href="?module=<?php echo $this->curModule(); ?>&action=edit&id=<?php echo $valueCon['0']; ?>" title="Edit"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="?module=<?php echo $this->curModule(); ?>&action=toggle&id=<?php echo $valueCon['0']; ?>" title="Disable/Enable"><span class="glyphicon glyphicon-off"></span></a>
                    <a href="?module=<?php echo $this->curModule(); ?>&action=delete&id=<?php echo $valueCon['0']; ?>" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
<?php } ?>



        </table>
        <div class="col-md-10 col-md-offset-1 text-center">
            <ul class="pagination">
<?php if($this->pageContent['pageCur'] == '1') { ?>
                <li class="disabled"><a href="">&laquo;</a></li>
<?php } else { ?>
                <li><a href="?module=<?php echo $this->curModule(); ?>&page=<?php echo $this->pageContent['pagePvs']; ?>">&laquo;</a></li>
<?php } ?>
<?php for($p = 1; $p <= $this->pageContent['pageCount']; $p++) { ?>
<?php if($this->pageContent['pageCur'] == $p) { ?>
                <li class="active"><a href="?module=<?php echo $this->curModule(); ?>&page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
<?php } else { ?>
                <li><a href="?module=<?php echo $this->curModule(); ?>&page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
<?php } ?>
<?php } ?>
<?php if($this->pageContent['pageCur'] == $this->pageContent['pageCount']) { ?>
                <li class="disabled"><a href="">&laquo;</a></li>
<?php } else { ?>
                <li><a href="?module=<?php echo $this->curModule(); ?>&page=<?php echo $this->pageContent['pagePvs']; ?>">&laquo;</a></li>
<?php } ?>
            </ul>
        </div>
<?php } // End IF 'type' ?>



        </div>



    </div>

