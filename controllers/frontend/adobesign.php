<?php
/***************************************************************************
 *                                                                          *
 *   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
 *                                                                          *
 * This  is  commercial  software,  only  users  who have purchased a valid *
 * license  and  accept  to the terms of the  License Agreement can install *
 * and use this program.                                                    *
 *                                                                          *
 ****************************************************************************
 * PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
 * "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
 ****************************************************************************/
    use Tygh\Addons\AdvancedImport\Exceptions\DownloadException;
    use Tygh\Addons\AdvancedImport\Exceptions\FileNotFoundException;
    use Tygh\Addons\AdvancedImport\Exceptions\ReaderNotFoundException;
    use Tygh\Enum\Addons\AdvancedImport\ImportStatuses;
    use Tygh\Addons\AdvancedImport\ServiceProvider;
    use Tygh\Enum\Addons\AdvancedImport\RelatedObjectTypes;
    use Tygh\Enum\NotificationSeverity;
    use Tygh\Exceptions\PermissionsException;
    use Tygh\Registry;
    use Tygh\Http;
    use Tygh;
    defined('BOOTSTRAP') or die('Access denied');
    if($_REQUEST['order_id']&&$_REQUEST['type']=='sign'){
        fn_your_addon_get_customer_info();
    }
    if($_REQUEST['type']=='save'){
        checkSign();
    }
    function fn_your_addon_get_customer_info()
    {
        $order_id = $_REQUEST['order_id'];
        $order = fn_get_order_info($order_id);
        $user_data= fn_get_user_info($order['user_id']);
        foreach ($order['products'] as $key => $item) {
            $product_data[] = fn_get_product_name($item['product_id']);
            $company_data = fn_get_company_data($item['extra']['company_id']);
        }
        $product_data = implode(",", $product_data);
        exportPDF($product_data,$user_data,$company_data);
    }
    function checkSign(){
        echo "failed";
        exit;
    }
    function exportPDF($product,$user,$company){
        // require_once('TCPDF/examples/tcpdf_include.php');
        // // create new PDF document
        // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, "B5", true, 'UTF-8', false);
        // // set document information
        // $pdf->setCreator(PDF_CREATOR);
        // $pdf->setTitle('Order Contract');
        // // set default monospaced font
        // $pdf->setHeaderData("logo-props4hire.com.png", "140", "".' ', "", array(255,255,255), array(255,255,255));
        // $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        // // set margins
        // $pdf->setMargins(PDF_MARGIN_LEFT, "30", PDF_MARGIN_RIGHT);
        // $pdf->setHeaderMargin("5");
        // // set image scale factor
        // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        // // set some language-dependent strings (optional)
        // if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        //     require_once(dirname(__FILE__).'/lang/eng.php');
        //     $pdf->setLanguageArray($l);
        // }
        // // set default font subsetting mode
        // $pdf->setFontSubsetting(true);
        // // Set font
        // // dejavusans is a UTF-8 Unicode font, if you only need to
        // // print standard ASCII chars, you can use core fonts like
        // // helvetica or times to reduce file size.
        // $pdf->setFont('dejavusans', '', 7, '', true);
        // // Add a page
        // // This method has several options, check the source code documentation for more information.
        // $pdf->AddPage();

        // // set text shadow effect
        // // $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
        // // <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
        // //             <img src="/images/logos/2/logo-props4hire.com.png" alt="props4hire"/>
        // //         </div>
        // // Set some content to print
        // $html = <<<EOD

        //             <strong>Props4hire Rental Agreement</strong>
                    
        //             <p>This Rental Agreement ("Agreement") is entered into on [Date] between</p>
                    


        //             <strong>Hirer:</strong><p>Name: [Hirer's Name]</p>
                    
        //             <p>Address: [Hirer's Address] </p>
                    
        //             <p>Phone: [Hirer's Phone Number] </p>
                    
        //             <p>Email: [Hirer's Email Address] </p>
                    


        //             <strong>Hiree:</strong><p>Name: [Hiree's Name]
        //             </p>
                    
        //             <p>Company (if applicable): [Hiree's Company Name] </p>
                    
        //             <p>Address: [Hiree's Address]</p>
                    
        //             <p>Phone: [Hiree's Phone Number]</p>
                    
        //             <p>Email: [Hiree's Email Address]</p>
                    


        //             <strong>Item(s) to be Rented:</strong>
                    
        //             <ul>
        //                 <li>Description of Item(s): [List of rented items]</li>
        //                 <li>Rental Period: [Start Date] to [End Date]</li>
        //             </ul>
                    


        //             <strong>Terms and Conditions:</strong>
                    
                    
        //             <ol>
        //                 <li><strong>Payment:</strong>The hirer agrees to pay the hiree the agreed-upon rental fee for the item(s) in
        //                     advance through Props4hire's escrow service. The hiree will receive payment upon the
        //                     successful return of the item(s) in acceptable condition</li>
        //                 <li><strong>Deposit:</strong>The hirer agrees to pay any temporary holding deposit that may be required by the
        //                     hiree into the Props4hire escrow service.</li>
        //                 <li><strong>Item Condition:</strong>The hirer agrees to return the rented item(s) in the same condition as
        //                     received, normal wear and tear excepted. Any damage or loss to the item(s) will be the
        //                     responsibility of the hirer, and repair or replacement costs will be deducted from the escrowed
        //                     funds.</li>
        //                 <li><strong>Rental Period:</strong>The rental period begins on the start date and ends on the end date specified
        //                     above. The hirer must return the item(s) promptly by the end date to avoid additional charges</li>
        //                 <li><strong>Cancellations:</strong>Cancellations must be made in accordance with Props4hire's cancellation
        //                     policy, which can be found on the platform</li>
        //                 <li><strong>Use of Item(s):</strong>The hirer agrees to use the rented item(s) only for their intended purpose and
        //                     in a safe and lawful manner. Any misuse or illegal use of the item(s) is prohibited</li>
        //                 <li><strong>Insurance:</strong>It is recommended that the hirer obtain insurance to cover any unforeseen events,
        //                     loss, or damage to the item(s) during the rental period.
        //                     </li>
        //                 <li><strong>Dispute Resolution:</strong>Any disputes arising from this rental agreement will be resolved through
        //                     Props4hire's dispute resolution process.</li>
        //                 <li><strong>Termination:</strong>Props4hire reserves the right to terminate this agreement and remove users
        //                     from the platform for violations of the terms and conditions.
        //                     </li>
        //             </ol>
                    


        //             <strong>Agreement Acceptance:</strong>
                    
        //             <p>By signing below, both the hirer and hiree acknowledge that they have read and agreed to the terms and
        //                 conditions of this rental agreement.</p>
                    
        //             <p><strong>Hirer's Signature:</strong>____________________________<strong>Date:</strong>_____________</p>
        //             <p><strong>Hiree's Signature:</strong>____________________________<strong>Date:</strong>_____________</p>

        // EOD;
        // // Print text using writeHTMLCell()
        // $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // // ---------------------------------------------------------
        // // Close and output PDF document
        // // This method has several options, check the source code documentation for more information.
        // // $indexDir = dirname(__FILE__);
        // // $output_file = $indexDir.'/order_contract.pdf';
        // // $pdf->Output($output_file, 'D');
        // $pdf->Output('order_contract', 'I');
        $date = date("m/d/Y");
        $html = <<<EOD
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>
                <style>
                </style>
                <div style="margin:50px 100px;">
                    <div style="display: flex; justify-content: center; align-items: center; text-align: center;">
                        <img src="https://www.props4hire.com/images/logos/2/logo-props4hire.com.png" alt="props4hire"/>
                    </div>
                    <div>
                        <strong>Props4hire Rental Agreement</strong>
                        
                        <p>This Rental Agreement ("Agreement") is entered into on {$date} between</p>
                        


                        <strong>Hirer:</strong><p>Name: {$user['firstname']} {$user['lastname']}</p>
                        
                        <p>Address: {$user['b_address']} </p>
                        
                        <p>Phone: {$user['phone']} </p>
                        
                        <p>Email: {$user['email']} </p>
                        


                        <strong>Hiree:</strong><p>Name: {$company['company']}
                        </p>
                        
                        <p>Company (if applicable): {$company['company']} </p>
                        
                        <p>Address: {$company['address']}</p>
                        
                        <p>Phone: {$company['phone']}</p>
                        
                        <p>Email: {$company['email']}</p>
                        


                        <strong>Item(s) to be Rented:</strong>
                        
                        <ul>
                            <li>Description of Item(s): [{$product}]</li>
                            <li>Rental Period: [Start Date] to [End Date]</li>
                        </ul>
                        


                        <strong>Terms and Conditions:</strong>
                        
                        
                        <ol>
                            <li><strong>Payment:</strong>The hirer agrees to pay the hiree the agreed-upon rental fee for the item(s) in
                                advance through Props4hire's escrow service. The hiree will receive payment upon the
                                successful return of the item(s) in acceptable condition</li>
                            <li><strong>Deposit:</strong>The hirer agrees to pay any temporary holding deposit that may be required by the
                                hiree into the Props4hire escrow service.</li>
                            <li><strong>Item Condition:</strong>The hirer agrees to return the rented item(s) in the same condition as
                                received, normal wear and tear excepted. Any damage or loss to the item(s) will be the
                                responsibility of the hirer, and repair or replacement costs will be deducted from the escrowed
                                funds.</li>
                            <li><strong>Rental Period:</strong>The rental period begins on the start date and ends on the end date specified
                                above. The hirer must return the item(s) promptly by the end date to avoid additional charges</li>
                            <li><strong>Cancellations:</strong>Cancellations must be made in accordance with Props4hire's cancellation
                                policy, which can be found on the platform</li>
                            <li><strong>Use of Item(s):</strong>The hirer agrees to use the rented item(s) only for their intended purpose and
                                in a safe and lawful manner. Any misuse or illegal use of the item(s) is prohibited</li>
                            <li><strong>Insurance:</strong>It is recommended that the hirer obtain insurance to cover any unforeseen events,
                                loss, or damage to the item(s) during the rental period.
                                </li>
                            <li><strong>Dispute Resolution:</strong>Any disputes arising from this rental agreement will be resolved through
                                Props4hire's dispute resolution process.</li>
                            <li><strong>Termination:</strong>Props4hire reserves the right to terminate this agreement and remove users
                                from the platform for violations of the terms and conditions.
                                </li>
                        </ol>
                        


                        <strong>Agreement Acceptance:</strong>
                        
                        <p>By signing below, both the hirer and hiree acknowledge that they have read and agreed to the terms and
                            conditions of this rental agreement.</p>
                        

                        <div style="display: flex;">
                            <strong>Hirer's Signature:</strong><input type="text"/><strong>Date: </strong><input type="date"/>
                        </div>
                        <div style="display: flex;">
                            <strong>Hiree's Signature:</strong><input type="text"/><strong>Date: </strong><input type="date"/>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        EOD;
        echo $html; exit;
    }

