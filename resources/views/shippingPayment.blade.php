@extends('layouts.app')
@section('style')
<style>
.content ul li{
    margin: 10px;
}
</style>
@endsection
@section('content')
<div class="col-md-12" id="content">
    <div class="row justify-content-center">
        <div class="breadcrumbs">
            <a href="url(/)"><i class="fa fa-home"></i></a>
            <a href="">Shipping And Payment</a>
        </div>
        <div class="col-md-12 content">
            <h2>
                Free shipping on orders over 1000 taka
            </h2>
            <h4>
                In case of refusal of all ordered things, the cost of delivery is paid in full.
            </h4>

            <h3>
                Cancellation, Returns and Refund Policy
            </h3>
            <h4>
                A: Cancellation Policy:
            </h4>
            <h5>
                Medicine Orders
            </h5>
            <p>
                An order can be cancelled from the ‘Order details’ screen on the Website before it is marked as out for
                delivery. Else, You can refuse it at the time of delivery and a refund will be processed into the
                payment
                source, in the event the order amount was paid online.
            </p>
            <h5>
                Healthcare Products
            </h5>
            <p>
                An order can be cancelled by getting in touch with our Customer Care team before the shipment is handed
                over to our logistics partner. Else, You can refuse it at the time of delivery and a refund will be
                processed into the payment source, in the event the order amount was paid online.
                Diagnostics Orders
            </p>
            <p>
                An order can be cancelled anytime unless it is marked 'Sample Collected' by the third-party
                phlebotomist.
                Else, You can refuse sample pick up at the collection location and a refund will be processed into the
                payment source, in the event the order amount was paid online.
            </p>
            <h5>
                B: Return Policy:
            </h5>
            Medicine Orders
            PharmEasy's return policy gives You an option to return the medicines purchased within 30 days of delivery.
            However, in case of refrigerated medicines, You can return the medicines within 3 days from the date of
            delivery of the medicines. You are requested to keep the copy of the invoice/bill from the licensed Retail
            Pharmacies handy for verification.
            o Eligibility of Medicines for Returns: Medicine(s) which are opened, partially used or disfigured are not
            eligible for returns. Please check the package carefully at the time of delivery.
            o Return Process: You can raise a request to return Your medicine(s) within 30 days of delivery with these
            simple steps:
            <ul>
                <li>1. Go to My Orders</li>
                <li>2. Select the respective order and click on 'RETURN'</li>
                <li>3. Select the item You wish to return with quantity and reason for return.</li>
            </ul>
            <p>
                We will pick up the return items within 1-7 days from the date of request. Please keep the return
                package
                ready in its original packaging.
            </p>
            <h5>
                Healthcare Products
            </h5>
            <p>
                Online medicine Center’s return policy gives You an option to return the healthcare products purchased
                within 2 days from the date of delivery.
            </p>
            Eligibility of Products for Returns- The Products shall not be eligible for a return under the following
            circumstances-
            <ul>
                <li>1. If the product is a consumable item;</li>
                <li>2. If the product has been tampered;</li>
                <li>3. If the product packaging and/or packaging box and/or packaging seal has been tampered;</li>
                <li>4. If it is mentioned on the product detail page that the product is non-returnable</li>
                <li>5. Any accessories supplied with the product are missing;</li>
                <li>6. If the product does not have a serial number or UPC number;</li>
                <li>7. Any damage / defect which is not covered under the manufacturer's warranty;</li>
                <li>8. The product is without original packing and accessories;</li>
                <li>9. If the product is damaged due to misuse;</li>
                <li>10. Products related to baby care, food & nutrition, healthcare devices and sexual wellness such as but
                </li>
            </ul>
            not limited to diapers, health drinks, health supplements, glucometers, glucometer strips/lancets, health
            monitors, condoms, pregnancy/fertility kits, etc.
            <h5>
                C: Refund Policy:
            </h5>
            Once the refund has been initiated for eligible returns as mentioned above, the amount is expected to
            reflect in your account as per the following timelines:
            <ul>
                <li>1. PharmEasy wallet: Same day;</li>
                <li>2. NEFT: 1-3 business days post refund initiation;</li>
                <li>3. Online refund: 7-10 business days post refund initiation subject to the bank turnaround time and RBI Guidelines.</li>
                <li>4. PhonePe and other wallets: 2-3 business days post refund initiation.</li>
            </ul>
            *The MRP mentioned at the time of return is without discount and total amount to be refunded listed is an
            estimate. Total amount paid by You for the medicine(s) will be refunded once pick up is completed and
            verified by the third-party licensed Retail Pharmacies.

        </div>
    </div>
</div>

@endsection
