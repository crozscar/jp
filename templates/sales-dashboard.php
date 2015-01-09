<?php 
#require_once('includes/lib/includes.php'); 
//$paging_obj       =  new Paging(20,$sql_obj);
//$limit     =  $paging_obj->getLimit();
?>
<?php #require_once('includes/subpages/header.php'); ?>
<div class="page-container"> 
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar navbar-collapse collapse"> 
    <!-- BEGIN SIDEBAR MENU -->
    <?php require_once('includes/subpages/sidebar.php'); ?>
    
    <!-- END SIDEBAR MENU --> 
  </div>
  <!-- END SIDEBAR --> 
  <!-- BEGIN PAGE -->
  <div class="page-content"> 
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body"> Widget settings form goes here </div>
          <div class="modal-footer">
            <button type="button" class="btn blue">Save changes</button>
            <button type="button" class="btn default" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content --> 
      </div>
      <!-- /.modal-dialog --> 
    </div>
    <!-- /.modal --> 
    <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--> 
    <!-- BEGIN STYLE CUSTOMIZER -->
    <?php require_once('includes/subpages/theme-style.php'); ?>
    
    <!-- END BEGIN STYLE CUSTOMIZER --> 
    <!-- BEGIN PAGE HEADER-->
    <div class="row">
      <div class="col-md-12"> 
        
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">Sales Dashboard</h3>
        <ul class="page-breadcrumb breadcrumb">
          <!--<li class="btn-group">
            <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true"> <span>Actions</span> <i class="fa fa-angle-down"></i> </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li><a href="?cmd=refresh&page=feedbacks">Refresh</a></li>
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>-->
          <li> <i class="fa fa-home"></i> <a href="index.php">Home</a> <i class="fa fa-angle-right"></i> </li>
          <li>
          <?php if(isset($_GET['p'])){ ?>
           <a  onClick="goBack(<?php echo $_GET['p'] ?>)">Sales Dashboard</a> </li>
           <?php }else{ ?>
           <a onClick="goBack('1')">Sales Dashboard</a> </li>
           <?php } ?>
        
          <li> <span id="oid"></span> </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB--> 
      </div>
    </div>
    <!-- END PAGE HEADER--> 
    <!-- BEGIN PAGE CONTENT-->
    
    <div id="sdash">
    <div class="row" >
      <div class="col-md-12">
        <div class="tabbable tabbable-custom boxless">
          <div class="col-md-12"> 
            <div class="tab-content">
              <div style="margin-bottom: 12px;">
              	<form action="" methon="GET">
		  <input type="hidden" name="page" value="<?=$_TPLT->pageModule?>"/>
		  <input type="hidden" name="p" value="<?=$_TPLT->curPage?>"/>
              	  <strong style="margin-right: 6px;">Filter by Transaction Date:</strong>
	              <?php $months = array('January','February','March','April','May','June','July','August','September','October','November','December');?>
	              Month: 
	              <select name="month" style="margin-right: 6px;">
	              	<option value="0">All</option>
	              <?php foreach($months as $k => $month):?><option value="<?=($k+1)?>" <?php if($_REQUEST['month'] == ($k+1)):?>selected="selected"<?php endif;?>><?=$month?></option><?php endforeach;?>
	              </select>
	              Year: 
	              <select name="year" style="margin-right: 6px;">
	              	<option value="0">All</option>
	              	<?php for($y = date('Y'); $y >= (date('Y')-10); $y--):?><option value="<?=$y?>" <?php if($_REQUEST['year'] == $y):?>selected="selected"<?php endif;?>><?=$y?></option><?php endfor;?>
	              </select>
	              <button class="btn btn-primary" id="transDateFilter">GO</button>
	        </form>
              </div>
              <!-- End Enhancement -->
            
              <div class="tab-pane active" id="tab_1">
                <div class="portlet box blue">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list-ul"></i>Sales Dashboard</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
                  </div>
                  <div class="portlet-body flip-scroll">
                  <div id="order-details" >
                  
                    <table class="table table-bordered table-striped table-condensed flip-content">
                      <thead class="flip-content">
                        <tr>
                          <th width="74">Date</th>		
                          <th width="44">Order Detial</th>  
                          <th width="62">Sale Price</th>
                          <th width="66">Net Profit</th>
                          <th width="57">Profit %</th>
                          <th width="50">ROI %</th>
                          <th width="50">ROI %</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        
			if(!empty($orders)):
			  foreach($orders as $key => $order):
	   
		        ?>
      					
                        <tr class="odd" id="s<?=$order->id?>">
                          <td><?=date("d M, Y", strtotime($order->transaction_date))?></td>
                          <td><?='<a  onClick="orderDetail('."'".$order->order_id."'".')">'.$order->order_id.'</a><br/>'.$order->product_name?></td>
                          <td>$<?=round($order->sales_price, 2); ?></td>
                          <td>
			    <?php  
			      $profit = $order->sales_price -
					abs($order->FBAPerOrderFulfillmentFee) -
					abs($order->FBAPerUnitFulfillmentFee) -
					abs($order->FBAWeightBasedFee) -
					abs($order->Commission) -
					abs($order->ShippingChargeback);
			      echo $profit;
			
			    ?></td>
                          <td>
			    <?php  
			      $profit_percent =	round(($profit / $order->sales_price) * 100 ,2);
			      echo $profit_percent;?>%
			  </td>
                          <td><?=$order->sales_tax?></td>
                          <td><?=$order->sales_price?></td>
                          
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <?php else: ?>
                      <tr>
                        <th colspan="17">Sorry! Your have no record :(</th>
                      </tr>
                      <?php endif; ?>
                    </table>
                    </div>
                  </div>
                </div>
                <?php
		  $_TPLT->displayPagination();
		 /////////////////
		 #echo $paging_obj->showPaging(20,"sale_orders","","paging","next");
		?>
              </div>
            </div>
          </div>
        </div>
      
      </div>
      <!-- END PAGE --> 
    </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    
    $('li.disabled, li.active').on('click',function(e){e.preventDefault()})
    
  });
  
</script>
