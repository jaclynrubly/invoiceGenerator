<?php
    //Error is given if the fpdf is not found.
    require '/home/mrubly/public_html/nixtreecare/fpdf181/fpdf.php';
    //require '/home/mrubly/public_html/nixtreecare/test1/html_table.php';

    $cName = $_POST['customerName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $number = $_POST['phone'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $jAddress = $_POST['jobAddress'];
    $jCity = $_POST['jobCity'];
    $date = $_POST['date'];
    $estimator = $_POST['estimator'];
    $dApproved = $_POST['approvalDate'];
    $refNum = $_POST['refrenceNum'];
    $contact = $_POST['contact'];
    $subTotal = $_POST['subtotal'];
    $tax =  $_POST['taxes'];
    $total = $_POST['total'];
    $formType = $_POST['formType'];
    
    function inputCheck($checkThis){
        if(isset($_POST[$checkThis])){
            return 'X';
        }
    }
    
    $noClean = inputCheck("noClean");
    $haulBrush = inputCheck("haulBrush");
    $haulWood = inputCheck("haulWood");
    $haulStump = inputCheck("haulStump");
    $leaveWood = inputCheck("leaveWood");
    $otherService = inputCheck("other");        

    //make arrays for multiple jobs
    $species= array();
    $location= array();
    $description= array();
    $remove= array();
    $pruning= array();
    $stump= array();
    $amnt= array();
    
    //fill in the jobs
    for($i=1;$i<=5;$i++){
        $temp = "species".$i;
        $species[$i]= $_POST[$temp];
        $temp = "location".$i;
        $location[$i]= $_POST[$temp];
        $temp = "description".$i;
        $description[$i]= $_POST[$temp];
        $temp = "remove".$i;
        
         if(isset($_POST[$temp])){
                  $remove[$i]= 'X';
         }
         $temp = "prune".$i;
         if(isset($_POST[$temp])){
                  $pruning[$i]= 'X';
         }
         $temp = "stump".$i;
         if(isset($_POST[$temp])){
                  $stump[$i]= 'X';
         }
        
        $temp = "amount".$i;
        $amnt[$i]=$_POST[$temp];
//             array(
//             $i=>$_POST['amount'.$i]
//             );
   }


    //page positioning
    $quart = 196/4;
    $half = 196/2;
    $threeQuart = $half + $quart;
    $eighth = $quart / 2;
    
    //Create new fpdf instance
    $pdf = new FPDF('P','mm','Letter');

    //add new page to pdf doc
    $pdf->addPage();
    
    
    
    //LOGO at UPPER LEFT CORNER
    $pdf->Image('/home/mrubly/public_html/nixtreecare/imgs/logo.jpg', 10,10,-300);
    //Top blank spot
    $pdf->Cell(136, 10, '',0,0);
    
    //set font for estimate/invoice
    $pdf->SetFont('Arial','B',10);
    
    //Estimate or Invoice
    $pdf->Cell(60, 10, $formType,0,1, 'C');

       
    //Set the font for Company name
    $pdf->SetFont('Arial','B',16);
    
    //Company Name
    //cell(width, height, text, border, end line, [align])
    $pdf->Cell(0, 5, 'Nix Tree Care LLC',0,1, 'C');
    $pdf->Cell(0, 3, '',0,1);

    //Company Info
    
    //set font for rest of header
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(0, 5, 'NixTreeCare.com',0,1, 'C');
    $pdf->Cell(0, 5, 'Phone: 253.229.1232',0,1, 'C');
    $pdf->Cell(0, 5, 'Nick@nixtreecare.com',0,1, 'C');
    $pdf->Cell(0, 5, 'ISA-PN/7761A',0,1, 'C');
    //end of header
    
    //new line
    $pdf->Cell(0, 5, '',0,1);
    
    //Customer information
    $pdf->Cell($quart, 5, 'Customer Name: ',0,0, 'R');
    $pdf->Cell($quart, 5, $cName,0,0, 'L');
    $pdf->Cell($quart, 5, 'Job Location: ', 0, 0, 'R');
    $pdf->Cell($quart, 5, $jAddress, 0, 1, 'L');

    $pdf->Cell($quart, 5, 'Address: ',0,0, 'R');
    $pdf->Cell($quart, 5, $address,0,0, 'L');
    $pdf->Cell($quart, 5, '',0,0);
    $pdf->Cell($quart, 5, $jCity,0,1);

    $pdf->Cell($quart, 5, 'City: ',0,0, 'R');
    $pdf->Cell($quart, 5, $city,0,1, 'L');

    $pdf->Cell($quart, 5, 'Phone/ Ext: ',0,0, 'R');
    $pdf->Cell($quart, 5, $number,0,0, 'L');
    $pdf->Cell($quart, 5, 'Mobile: ', 0, 0, 'R');
    $pdf->Cell($quart, 5, $mobile,0,1, 'L');

    $pdf->Cell($quart, 5, 'Email: ',0,0, 'R');
    $pdf->Cell($quart, 5, $email,0,1, 'L');
    //end of customer info
    
    //new line
    $pdf->Cell(0, 5, '',0,1);

    //First table- Top Row - date, estimator, etc.
    $pdf->Cell($eighth, 5);
    $pdf->Cell(18, 5, 'Date',1,0, 'C');
    $pdf->Cell(30, 5, 'Estimator',1,0, 'C');    
    $pdf->Cell(30, 5, 'Date Approved',1,0, 'C');    
    $pdf->Cell(30, 5, 'Invoice #',1,0, 'C');
    $pdf->Cell(30, 5, 'Contact',1,1, 'C');

    //data to be input
    $pdf->SetFont('Arial','',8);
    $pdf->Cell($eighth, 5);
    $pdf->Cell(18, 5, $date,1,0, 'C');
    $pdf->Cell(30, 5, $estimator,1,0, 'C');    
    $pdf->Cell(30, 5, $dApproved,1,0, 'C');    
    $pdf->Cell(30, 5, $refNum,1,0, 'C');
    $pdf->Cell(30, 5, $contact,1,1, 'C');
    $pdf->SetFont('Arial','',10);
    //end of first table

    //new line
    $pdf->Cell(0, 5, '',0,1);

    //Second table- Top Row - Species, location, etc.
    $pdf->Cell(30, 5, 'Species',1,0, 'C');
    $pdf->Cell(35, 5, 'Location',1,0, 'C');    
    $pdf->Cell(45, 5, 'Job Description',1,0, 'C');    
    $pdf->Cell(15, 5, 'Remove',1,0, 'C');
    $pdf->Cell(15, 5, 'Prune',1,0, 'C');
    $pdf->Cell(15, 5, 'Stump',1,0, 'C');
    $pdf->Cell(30, 5, 'Amount',1,1, 'C');

    //data to be input
    for ($i=1;$i<=5;$i++)
    {   
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30, 5, $species[$i],1,0, 'C');
        $pdf->Cell(35, 5, $location[$i],1,0, 'C');    
        $pdf->Cell(45, 5, $description[$i],1,0, 'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15, 5, $remove[$i],1,0, 'C');
        $pdf->Cell(15, 5, $pruning[$i],1,0, 'C');
        $pdf->Cell(15, 5, $stump[$i],1,0, 'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(30, 5, $amnt[$i],1,1, 'C');
        $pdf->SetFont('Arial','',10);
    }
    //end of Second table
    
    //Form totals
    $pdf->Cell($threeQuart, 5, 'Subtotal:',0,0, 'R');
    $pdf->Cell(24, 5, $subTotal,0,1,'L');
    
    $pdf->Cell($threeQuart, 5, 'Tax: ',0,0, 'R');
    $pdf->Cell(24, 5, $tax,0,1,'L');

    $pdf->Cell($threeQuart, 5, 'Total Amount Due: ',0,0, 'R');
    $pdf->Cell(24, 5, $total,0,1,'L');
    //end of totals

    //double new line
    $pdf->Cell(0, 10, '',0,1);

    //Third table - Job details - and warranty
    $pdf->Cell(15,5,$noClean,1,0,'C');
    $pdf->Cell(90,5,'No Clean Up',1,1,'L');
    
    
    $pdf->Cell(15,5,$haulBrush,1,0,'C');
    $pdf->Cell(90,5,'Haul Brush',1,0,'L');   
    
    //warranty line 1
    $pdf->Cell(10,45,'',0,0);
    $pdf->Cell(60,5,'This Estimate Is Valid 30 Days From','LRT',1,'L');
    //END warranty ln 1
    
    $pdf->Cell(15,5,$haulWood,1,0,'C');
    $pdf->Cell(90,5,'Haul Wood',1,0,'L');

    //warranty line 2
    $pdf->Cell(10,45,'',0,0);
    $pdf->Cell(60,5,'The Date Issued. If You Have Any','LR',1,'L');
    //END warranty ln 2

    $pdf->Cell(15,5,$haulStump,1,0,'C');
    $pdf->Cell(90,5,'Haul Stump Chips',1,0,'L');

    //warranty line 3
    $pdf->Cell(10,45,'',0,0);
    $pdf->Cell(60,5,'Questions Please Contact','LR',1,'L');
    //END warranty ln 3
    
    $pdf->Cell(15,5,$leaveWood,1,0,'C');
    $pdf->Cell(90,5,'Leave Wood Onsite',1,0,'L');

    //warranty line 4
    $pdf->Cell(10,45,'',0,0);
    $pdf->Cell(60,5,'NIX TREE CARE LLC.','LRB',1,'L');
    //END warranty ln 4
       
    $pdf->Cell(15,5,$otherService,1,0,'C');
    $pdf->Cell(90,5,'Other: ',1,0,'L');
    
    //end of third table - job details
    
    //triple new line
    $pdf->Cell(0, 15, '',0,1);

    //signatures
    $pdf->Cell(20,5,'');
    $pdf->Cell(60,5,' X', 'B');//customer
    
    $pdf->Cell(20,5,'');
    $pdf->Cell(60,5,' Nick Clark','B',1);//estimator

    $pdf->Cell(20,5,'');
    $pdf->Cell(60,5, 'Customer');//customer
    
    $pdf->Cell(20,5,'');
    $pdf->Cell(60,5,'Estimator');//estimator
    //end of signatures
    
    //Big area new line
    $pdf->Cell(0, 30, '',0,1);

    $pdf->Cell(15, 5,'');
    $pdf->MultiCell(166,5,'By signing this document you, the customer, allow NIX TREE CARE LLC & all employees permission to access the property listed above in order to complete all detailed work on approved date. The customer agrees to pay in full upon completion of work. NIX TREE CARE LLC is a Licensed, Bonded and Insured company. NIX TREE CARE LLC is not responsible for any underground property unless previously disclosed.',0,'C');
    
    

    $pdf->Output();
?>