<?php
ob_start('ob_gzhandler');
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
$maxage = date('Y') - 62;
$minage = date('Y') - 18;

if (strlen($_REQUEST['source']) > 0) {
    $retrivesource = $_REQUEST['source'];
} else {
    $retrivesource = "PL Site Page";
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Personal Loan - Compare Rates & EMI of HDFC, ICICI, Axis, Bajaj Finserv at Deal4loans</title>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" media="all" />
        <link href="css/d4l-styles.css" type="text/css" rel="stylesheet" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <meta name="description" content="Personal Loan: Compare top 20+ Banks instantly at Deal4loans on the basis of EMI, Eligibility, Disbursal time, Processing Fees, application status, procedure, documentation <?php echo DATE('F'); ?> 2017.">
        <meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, online personal loans, Personal Loans India">
    </head>
    <body class="body-d4l">
<?php include "include/menu.php"; ?>
        <div class="d4l-breadcrumb">
            <div class="container">
                <ul>
                    <li class="d4l-breadcrumb-arrow"><a href="/">Home</a></li>
                    <li>Personal Loan</li>
                </ul>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Personal Loan</h1>
                        <p>Personal loan is the obvious choice if you need a finance for Personal finance, Medical emergency, Wedding purposes, Abroad travel, Holidays, Child education and for buying consumer durable things. Means if you have a requirement of money so personal loan is the best choice.</p>
                        <h2>Personal loan Eligibility</h2>
                        <div class="body-d4l-orderlist">
                            <ol>
                                <li>Minimum per month Income of Rs.18500 in Metro cities required.</li>
                                <li>Minimum per Month Income of 12500 required in other cities like Tier 1, 2 & 3.</li>
                                <li>Age Must be above 21 Years.</li>
                                <li>Regular Source of Income with Valid proof of income like - Pay Cheque, Account Transfer. Cash salary is not considered by any bank.</li>
                                <li>Minimum 6 Month stability in current company for Salaried, 2 Years ITR for self-employed / Professionals.</li>
                                <li>CIBIL Score must be above 750 points.</li>
                            </ol>
                        </div>
                        <?php
                        $source = $retrivesource;
                        $TagLine = "Compare Personal Loan Offers from Top Banks - Apply Online and Get e-Approved Instantly.";
                        $PostURL = "personal-loans2.php";
                        $TypeLoan = "Req_Loan_Personal";
                        include "include/personal-loan-widget.php";
                        ?>

<?php include "include/personal-loan-offer-widget.php"; ?>

                        <h2>Personal loan Interest Rates</h2>
                        <p>Interest rates on any loan plays an important part so always choose the lowest one is beneficial. Personal loan interest rates for most of the banks starts from 11.59% to 22.00%. Some banks offer special interest rates to its customer
                            on the basis of Company, Profile, Residential status, Income per month. Banks offer lowest rates to only CAT A based company employees. So have a look at major banks personal loan interest rates below:</p>
                        <h3 class="table-h3">Compare Top Personal Loan Banks on the Basis of Interest Rates, Processing Fees, Prepayment Charges & Approval Time</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Bank</td>
                                    <td>Interest Rates</td>
                                    <td>Processing Fees</td>
                                    <td>Fore Closure Charges</td>
                                    <td>Disbursal Time</td>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/personal-loan-stanc-bank.php">Standard Chartered Bank</a></td>
                                    <td>10.99% - 14.50%</td>
                                    <td>ZERO for ALL</td>
                                    <td>Upto 2%</td>
                                    <td>48 working hours</td>
                                </tr>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/personal-loan-icici-bank.php">ICICI Bank</a></td>
                                    <td>11% - 17.50%</td>
                                    <td>0.50% - 2.25% </td>
                                    <td>Zero above 10 lakh &amp; 12 EMI Paid, Otherwise 5.00%</td>
                                    <td>48 working hours</td>
                                </tr>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/hdfc-personal-loan-eligibility.php">HDFC Bank</a></td>
                                    <td>11.49% - 19.50%</td>
                                    <td>Now: Rs.999 for Special offers otherwise 1% - 2%)</td>
                                    <td>Zero above 10 lakh, Otherwise 4.00%
                                    </td>
                                    <td>48 working hours</td>
                                </tr>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/personal-loan-sbi.php">SBI Bank</a></td>
                                    <td>11.95% - 16.55% </td>
                                    <td>2.00% - 3.00%</td>
                                    <td>NIL</td>
                                    <td>72 working hours</td>
                                </tr>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/loans/personal-loan/bajaj-finserv-lending-personal-loan-eligibility-documents-interest-rates-apply/">Bajaj Finserv</a></td>
                                    <td>11.99% - 16.00%</td>
                                    <td>Upto 2.00%</td>
                                    <td>Upto 4% post 1st EMI clearance</td>
                                    <td>48 working hours</td>
                                </tr>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/kotak-personal-loan-eligibility.php">Kotak Bank</a></td>
                                    <td>11.29% - 20.15%</td>
                                    <td>Rs.999 - 2%</td>
                                    <td>Zero above 10 lakhs loan amount, Else 5.00%</td>
                                    <td>60 working hours</td>
                                </tr>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/fullerton-personal-loan-eligibility.php">Fullerton India</a></td>
                                    <td>19.50% - 37.00%</td>
                                    <td>2.00%</td>
                                    <td>Upto 7.00%, 0% after 3 years</td>
                                    <td>48 working hours</td>
                                </tr>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/personal-loan-axis-bank.php">Axis Bank</a></td>
                                    <td>15.00% - 20.00%</td>
                                    <td>2.00%</td>
                                    <td>N.A</td>
                                    <td>60 working hours</td>
                                </tr>
                                <tr>
                                    <td><a href="http://www.deal4loans.com/loans/personal-loan/tata-capital-personal-loans-interest-rates-documents-apply-online/">TATA Capital</a></td>
                                    <td>12.50% - 19.50%</td>
                                    <td>1.25% - 2.50%</td>
                                    <td>NIL</td>
                                    <td>72 working hours</td>
                                </tr>
                            </table>
                        </div>
                        <h2>Personal Loan Calculator</h2>
                        <p>Personal loan emi calculator is the essential tool which helps borrowers to check how much per month emi have to pay for the borrow amount from the bank. Borrowers calculate the per month emi on the basis or in just three simple steps</p>
                        <div class="body-d4l-orderlist">
                            <ol>
                                <li>Go to Calculator Page ( <a href="http://www.deal4loans.com/personal-loan-emi-calculator.php">http://www.deal4loans.com/personal-loan-emi-calculator.php</a>)</li>
                                <li>Enter required loan amount</li>
                                <li>Enter Interest rates on which bank offer the loan</li>
                                <li>Enter the tenure or repayment period</li>
                                <li>Then Calculate</li>
                            </ol>
                        </div>
                        <div class="lightblue-box">Results shown to you by calculator on the basis of your entered details in the calculator. For example if you applied for 2 lakh of loan amount @ 15.50% rate of interest for 4 years repayment period than you have to pay Rs. 5616.97
                            per month for 4 years.</div>
                        <h2>Personal loan Eligibility</h2>
                        <p>If you want to check for how much loan amount you are eligible, so go through this link which let you know the exact amount on the basis of your Net monthly Income, Liabilities, No. of dependents etc etc. <a href="http://www.deal4loans.com/personal-loan-eligibility-calculator.php">Click Here for calculate eligibility on personal loans</a>.</p>
                        <h4>List of Personal Loan Documents for Salaried, Self employed / Professionals</h4>
                        <p><a href="http://www.deal4loans.com/loans/personal-loan/personal-loan-documents-requirement-deal4loans/">-Check Here</a></p>
                        <h2>Personal Loan for Self Employed</h2>
                        <p>Almost all banks offers personal loan to self-employed persons on the basis of business stability & last 2 or 3 years Income tax returns. Interest rates are also on the higher side for the comparison to salaried people.</p>
                        <div class="body-d4l-orderlist">
                            <ol>
                                <li>Maximum loan amount avail upto 15 lakhs.</li>
                                <li>Maximum tenure period is 5 Years.</li>
                                <li>Mandatory bank account, Part payment option is not available for self employed borrowers.</li>
                            </ol>
                        </div>
                        <h2>Top Banks for Personal Loans in India</h2>
                        <h4>HDFC Bank Personal Loan</h4>
                        <p>HDFC bank offers personal loans to salaried, self employed, professionals, doctors, CA's for upto 25 lakh.</p>
                        <h5>Why to choose HDFC Bank?</h5>
                        <div class="body-d4l-orderlist">
                            <ol>
                                <li>No Hidden Charges, Reasonable processing fees</li>
                                <li>Special Offers for women borrowers</li>
                                <li>Be earning at least Rs. 12,000/- per month net income (Rs. 15,000/- in Mumbai, Delhi, Bangalore, Chennai, Hyderabad, Pune, Calcutta, Ahmedabad, Cochin)</li>
                                <li>Interest Rates starts from 11.99% p.a*</li>
                            </ol>
                        </div>
                        <h5>ICICI Bank Personal loan</h5>
                        <p>ICICI Bank offers personal loans up to Rs. 20 lakh for salaried, up to Rs.30 lakh for self employed and up to Rs.40 lakh for doctors. ICICI Bank offer flexible repayment option of 12-60* months.</p>
                        <div class="body-d4l-orderlist">
                            <ol>
                                <li>Interest Rates starts from 11.49% p.a*</li>
                                <li>Disbursement within 72 working hours</li>
                                <li>No Security / No Collateral</li>
                                <li>Flexible tenures upto 60 months.</li>
                            </ol>
                        </div>
                        <h5>Axis Bank Personal loan</h5>
                        <p>Axis bank's personal loans will give you a helping hand meet all your personal requirements.</p>
                        <div class="body-d4l-orderlist">
                            <ol>
                                <li>Loan amount from 50000 to 15 Lakh</li>
                                <li>Loan available to salaried individuals only</li>
                                <li>Simple procedure, minimal documentation and quick approval</li>
                                <li>Rate of Interest starts from 15.00% p.a*</li>
                                <li>Available in 65 Locations throughout the India</li>
                            </ol>
                        </div>
                        <h5>SBI Personal Loan</h5>
                        <p>State Bank of India personal loan is the most searched term in government banks list. State bank of India offers personal loan to Salaried individual of good quality corporate, self employed, engineer, doctor, architect, chartered
                            accountant, MBA with minimum 2 years standing.</p>
                        <div class="body-d4l-orderlist">
                            <ol>
                                <li>Minimum Income required Rs.24,000/- in metro and urban centres</li>
                                <li>Minimum Income required Rs.10,000/- in rural/semi-urban centres</li>
                                <li>Interest Rates starts from as low as 12.60% p.a*</li>
                                <li>Zero pre payment charges</li>
                            </ol>
                        </div>
                        <h5>Bajaj Personal Loan</h5>
                        <p>Bajaj Finserv is the one of the fastest growing company in terms of personal loans as per current market scenarios. Borrowers looking for bajaj because of its best repayment plans, lowest rates & transparent policy.</p>
                        <div class="body-d4l-orderlist">
                            <ol>
                                <li>Instant Online Approval</li>
                                <li>Funds transfer to your account within 72 hours</li>
                                <li>Maximum loan amount of Upto 25 Lakh</li>
                                <li>Minimum Income required are Rs.25000</li>
                                <li>Processing Fees of 2.25% to 3.00% of the loan amount</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php include 'include/footer.php'; ?>
    </body>
</html>