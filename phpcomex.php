<?php
    print "Hi";
#Instantiate the spreadsheet component.
#    $ex = new COM("Excel.sheet") or Die ("Did not connect");
$exapp = new COM("Excel.application") or Die ("Did not connect");

#Get the application name and version   
print "Application name:{$ex->Application->value}<BR>" ;
print "Loaded version: {$ex->Application->version}<BR>";

$wkb=$exapp->Workbooks->add();
#$wkb = $ex->Application->ActiveWorkbook or Die ("Did not open workbook");
print "we opened workbook<BR>";

$ex->Application->Visible = 1; #Make Excel visible.
print "we made excell visible<BR>";

$sheets = $wkb->Worksheets(1); #Select the sheet
print "selected a sheet<BR>";
$sheets->activate; #Activate it
print "activated sheet<BR>";

#This is a new sheet
$sheets2 = $wkb->Worksheets->add(); #Add a sheet
print "added a new sheet<BR>";
$sheets2->activate; #Activate it
print "activated sheet<BR>";

$sheets2->name="Report Second page";

$sheets->name="Report First page";
print "We set a name to the sheet: $sheets->name<BR>";

# fills a columns
$maxi=20;
for ($i=1;$i<$maxi;$i++) {
    $cell = $sheets->Cells($i,5) ; #Select the cell (Row Column number)
    $cell->activate; #Activate the cell
    $cell->value = $i*$i; #Change it to 15000
}

$ch = $sheets->chartobjects->add(50, 40, 400, 100); # make a chartobject

$chartje = $ch->chart; # place a chart in the chart object
$chartje->activate; #activate chartobject
$chartje->ChartType=63;
$selected = $sheets->range("E1:E$maxi"); # set the data the chart uses
$chartje->setsourcedata($selected); # set the data the chart uses
print "set the data the chart uses <BR>";

$file_name="D:/apache/Apache/htdocs/alm/tmp/final14.xls";
if (file_exists($file_name)) {unlink($file_name);}
#$ex->Application->ActiveWorkbook->SaveAs($file_name); # saves sheet as final.xls
$wkb->SaveAs($file_name); # saves sheet as final.xls
print "saved<BR>";

#$ex->Application->ActiveWorkbook->Close("False");   
$exapp->Quit();
unset($exapp);
?>