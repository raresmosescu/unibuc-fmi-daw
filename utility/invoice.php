<?php
  require('fpdf/fpdf.php');
  require('data/database.php');

  class PDF_Invoice extends FPDF {
    function LoadData($order_id) {
      global $db;
      // Connect to the database and fetch the order details
      $result = $db->query("SELECT * FROM `order` WHERE id = $order_id");
      $order = $result->fetch_assoc();

      // Fetch the order items
      $items_result = $db->query("SELECT * FROM order_item WHERE order_id = {$order['id']}");
      $items = array();
      while ($row = $items_result->fetch_assoc()) {
          $items[] = $row;
      }

      return array($order, $items);
    }

    function Header() {
        // Title
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,'Invoice',0,1,'C');
    }

    function Footer() {
        // Position at 1.5cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function BasicTable($data) {
        $order = $data[0];
        $items = $data[1];

        // Add order details
        $this->SetFont('Arial','B',12);
        $this->Cell(0,10,'Order ID: '.$order['id'],0,1);
        $this->Cell(0,10,'Order Date: '.$order['created_at'],0,1);
        $this->Cell(0,10,'Customer Email: '.$order['email'],0,1);

        // Add table headings
        $this->SetFont('Arial','B',10);
        $this->Cell(120,7,'Product',1);
        $this->Cell(20,7,'Quantity',1);
        $this->Cell(30,7,'Price',1);
        $this->Ln();

        // Add order items
        $this->SetFont('Arial','',10);
        foreach ($items as $item) {
            $this->Cell(120,6,$item['product_name'],1);
            $this->Cell(20,6,$item['quantity'],1);
            $this->Cell(30,6,'$'.$item['price'],1);
            $this->Ln();
        }

        // Add total
        $this->Cell(60);
        $this->Cell(20,7,'Total:',0,0,'R');
        $this->Cell(30,7,'$'.$order['total'],0,0,'R');
    }
}