<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Mag-umagahan | Receipt</title>
    <link rel="stylesheet" href="styles/ProcessOrder.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inconsolata:wght@600&family=Roboto&display=swap');
    </style>
  </head>
  <body>
    <div class="container-flex">
      <?php
        // FUNCTION DECLARATIONS

        function getI($items){
          switch($items){
            case 'rice':      return 0; break;
            case 'friedrice': return 1; break;
            case 'water':     return 2; break;
            case 'tapsilog':  return 3; break;
            case 'porksilog': return 4; break;
            case 'tocilog':   return 5; break;
          }
        }

        function getGreet($gen){
          // Returns either Sir or Ma'am depending on checked gender
          switch($gen){
            case 'male': return "Sir"; break;
            case 'female': return "Ma'am"; break;
          }
        }

        function dec($n){
          // Formats numbers 0.00
          return number_format($n, 2);
        }

        function displayTr(){
          echo "<tr>";
          echo "<td></td>";
          echo "<td></td>";
        }

        // Get values from form
        // Personal Information Values
        $p_name = $_POST["name"];
        $p_gender = $_POST["gender"];
        $p_addr = $_POST["address"];
        $p_email = $_POST["email"];
        $p_order = $_POST["order"];
        $orderthru = strtoupper($p_order);

        // Get Mode of Payment values
        if (isset($_POST["mop"])) {
          if($_POST["mop"] == 'cash'){
            $p_mop = "CASH";
          } else {
            $p_mop = "CREDIT";
            $p_ccnum = $_POST["ccnum"];
          }
        }

        // Arrays for price and quantity
        $prcArr = array(dec(10.00),dec(12.00),dec(15.00),dec(45.00),dec(40.00),dec(35.00));
        $qtyArr = array();

        //  Assign delivery fee value if checked
        if($p_order == "delivery"){
          $deliveryFee = dec(40.00);
        } else {
          $deliveryFee = dec(0.00);
        }

        $totalPrice = dec(0);  # Initialize Total Price
        $arrCount = count($_POST['items']); # Item Count
        $greet = getGreet($p_gender); # Gets greeting

        for($i=1; $i<=6; $i++){
          array_push($qtyArr, isset($_POST["qty"."$i"]));
        }

        // Header
        echo "<h1 style='font-size:50px'>MAG UMAGAHAN<h1>";
        echo "<h1>CUSTOMER RECEIPT<h1>";
        echo "<h1>======================================================<h1>";
        echo "<br>";

        // Date & time
        echo "<h1>" . date( "m/d/Y",time() ) . ", " . date("H:i:s") . "</h1>";

        // Greeting
        echo "<p>Good day, $greet $p_name" . "!</p>";

        // TABLE
        echo "<table style='width=100%'>";
        echo "<caption>=======================" . "$orderthru" . "=======================</caption>";
        echo "<br>";
        echo "<tr>";
        echo "<th>Item</th>";
        echo "<th>Quantity</th>";
        echo "<th>Price</th>";
        echo "<th>Total</th>";
        echo "</tr>";

        // Display Items, Quantity, Price, Total via Table
        foreach($_POST['items'] as $items){
          $name = strtoupper($items);   # convert to uppercase
          $index = getI($items);        # get items's index
          $prc = dec($prcArr[$index]);  # get items's price

          echo "<tr>";
          echo "<td>$name</td>";
          echo "<td class='col-ctr'>$qtyArr[$index]</td>";
          echo "<td class='col-ctr'>P$prcArr[$index]</td>";

          $itemPrice = dec(($prcArr[$index]*$qtyArr[$index]));    # itemtotalprice = itemprice * quantity
          $totalPrice += dec(($prcArr[$index]*$qtyArr[$index]));  # itemtotalprice +=  itemprice * quantity
          $tax = dec($totalPrice * 0.12);                         # tax = itemtotalprice * 12%
          $totalWTax = dec($tax + $totalPrice + $deliveryFee);    # amounttopay = tax + itemtotalprice + deliveryfee

          echo "<td class='col-ctr'>P$itemPrice</td>";
          echo "</tr>";
        }

        displayTr();  # <tr><td></td><td></td>
        echo "<td id='prc-desc'>Before Tax</td>";
        echo "<td class='col-ctr' >P$totalPrice.00</td>";
        echo "</tr>";

        displayTr();  # <tr><td></td><td></td>
        echo "<td id='prc-desc'>EVAT (12%)</td>";
        echo "<td class='col-ctr' >P$tax</td>";
        echo "</tr>";

        displayTr();  # <tr><td></td><td></td>
        echo "<td id='prc-desc'>Delivery Fee</td>";
        echo "<td class='col-ctr' >P$deliveryFee</td>";
        echo "</tr>";

        displayTr();  # <tr><td></td><td></td>
        echo "<td id='prc-desc' style='font-size:35px'>TOTAL</td>";
        echo "<td class='col-ctr' style='font-size:35px'>P$totalWTax</td>";
        echo "</tr>";

        echo "</table>";  # !! closing table tag !!

        echo "<h1>======================================================<h1>";

        $print_mop = "*** " . "$p_mop" . " ***";

        echo "<table style='table-layout: fixed; width: 100%'>";
        echo "<tr>";
        echo "<td>$print_mop</td>";
        echo "<td></td>";
        echo "</tr>";

        if(isset($p_ccnum)){
          $maskedCC = ' *****-****-' . substr($p_ccnum,-4);

          echo "<tr>";
          echo "<td>ACC #:</td>";
          echo "<td style='text-align:right'>$maskedCC</td>";
          echo "</tr>";
        }

        $id = hexdec(uniqid());

        echo "<tr>";
        echo "<td>ORDER #:</td>";
        echo "<td style='text-align:right'>$id</td>";
        echo "</tr>";

        if($orderthru == "DELIVERY"){
          echo "<tr>";
          echo "<td>DLVRY LOC:</td>";
          echo "<td  style='word-wrap: break-word;  text-align:right;'>$p_addr</td>";
          echo "</tr>";
        }

        echo "</table>";  # !! closing table tag !!

        echo "<br><br>";
        echo "<h1>THANK YOU<h1>";
        echo "<h1>AND COME AGAIN!<h1>";
        echo "<br><br>";
       ?>
       <br>
       <button type="button" value="back-btn" class='back-btn'><a href="InputOrder.html">BACK</a></button>
    </div>

  </body>
</html>
