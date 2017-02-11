<?php  
$now = new DateTime(date('Y-m-d H:i:s'));
?>
<html>
 <head>
   <title><?php echo $title; ?></title><!-- 
   <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> -->
 </head>
 <body> <!--  onload="window.print()" -->
   <div class="wrapper">
      <div class="header">
         <div class="big-title"><?php echo $this->app->get('store_name'); ?></div>
         <div class="small-title"><?php echo $this->app->get('address'); ?></div>
         <hr>
      </div>
   </div>
   <div class="content" style="margin-top: 5px; margin-bottom: 30px; text-align: center; text-transform: uppercase;">
      <h3 style="font-family: 'Roboto Condensed', sans-serif; font-size:1.2em; font-weight: 500">Product Item</h3>
   </div>
   <div class="content">
      <table class="gridtable" width="100%">
        <thead>
          <tr class="mini-font">
            <th rowspan="2" width="40">No.</th>
            <th class="text-center">Code</th>
            <th class="text-center">Product Name</th>
            <th class="text-center">Category</th>
            <th class="text-center">Description</th>
            <th class="text-center">Price</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
         <tbody>
      <?php  
      /**
       * Loop Product Item
       *
       **/
      foreach($product as $key => $value) :
      ?>
            <tr>
              <td class="text-center"><?php echo ++$key; ?>.</td>
              <td class="text-center"><?php echo $value->code; ?></td>
              <td><?php echo $value->product_name; ?></td>
              <td><?php echo $value->product_sales; ?></td>
              <td><small><?php echo $value->description_product; ?></small></td>
              <td class="text-center">Rp. <?php echo number_format($value->price); ?></td>
              <td class="text-center"><?php echo ($value->status=='available') ? 'Available' : 'Unavailable'; ?></td>
            </tr>
      <?php  
      endforeach;
      ?>
         </tbody>
      </table>
      <p>
        <small>Total 3 from 10 data</small><br>
        <small>Printed by <strong>Vicky Nitinegoro</strong> on <?php echo date('l, d F Y H:i A') ?></small>
      </p>
   </div>
 </body>
</html> 

<style>
   table { font-size:12px; font-family:'Arial'; }
   .text-center { text-align: center; }
   .header { width:100%; height:5%; text-align:center; font-weight:500;  }
   .big-title {  font-family: 'Roboto Condensed', sans-serif; font-size:1.2em; font-weight: 400; padding-bottom: 4px; }
   .small-title {  font-family: 'Roboto Condensed', sans-serif; font-style: italic; font-size:0.5em;  }
   .content { font-size:12px; font-family:'Arial'; margin-top:-20px;}
   .upper { text-transform: uppercase;  }
   .underline { text-decoration: underline; }
   .bold { font-weight:bold; }
   small { font-family: 'Roboto Condensed', sans-serif; font-style: italic;  }
   table.gridtable {
      border-width: 0.5px;
      border-color: black;
      border-collapse: collapse; 
      font-size:0.8em;
   }
   table.gridtable th {
      border-width: 0.5px;
      padding: 5px;
      border-style: solid;
      border-color: black;
   }
   table.gridtable td {
      border-width: 0.5px;
      padding: 5px;
      border-style: solid;
      border-color: black;
   }
</style>

