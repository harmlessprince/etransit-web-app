@extends('layouts.app')
@section('content')
<style>
    p{
        line-height: 30px;
        text-align: justify;
    }
    @media only screen and (max-width: 900px) {
        .content {
            padding: 10px !important;
        }
    }
</style>

    <section id="about" class="about" style="background: transparent; color: black; margin-top: 20px;margin-bottom: 10px;">
        <div class="container">

            <div class="row no-gutters">
                <div class="content col-xl-12 d-flex align-items-stretch" data-aos="fade-right">
                    <div class="content">
                        <h3 class="text-black">Terms and Conditions</h3>
                        <p class="text-justify">
                            These General Terms and Conditions set out the terms and conditions applying to and governing the usage of the Etransit app – a one-stop technology platform for all transport and travel-related needs that connects users with various transportation and travel services to help them move around more efficiently.
                            The term “us” or “we” refers to Etransit Technology a private limited company incorporated and registered under the laws of the federal republic of Nigeria with RC 1818432 and registered office address 55b ogunlana drive Surulere.
                        </p>
                        <p>In order to use Etransit app you must agree to the terms and conditions that are set out below:</p>
                        <ol>
                            <h5 class="mb-3"><li>Using the Etransit app</li></h5>
                            <p>
                                1.1 Etransit provides an information society service through Etransit app that enables mediation of the requests for transport services between the passengers, drivers, vehicle owners, bus owners and other related transport service and Etransit does not provide transport services. Transport services are provided by transporters under a contract (with you) for the carriage of passengers. Transporters provide transport services on an independent basis (either in person or via a company) as economic and professional service providers. Etransit is not responsible in any way for the fulfillment of the contract entered into between the passenger (you) and the transporter. Disputes arising from consumer rights, legal obligations, or from the law applicable to the provision of transport services will be resolved between the passengers and drivers. Data regarding the transporter and their transport service is available in the Etransit app and receipts for journeys are sent to the email address listed in the passenger’s profile.
                            </p>
                            <p>
                                1.2 . The passenger (you) enters into a contract with the transporter for the provision of transport services via the Etransit app. Depending on the payment options supported for a given location of the journey, you can choose whether to pay the transporter for the transport service in cash or use Etransit in-App Payment. Charges will be inclusive of applicable taxes where required by law. Charges may include other applicable fees, tolls, and/or surcharges including a booking fees, municipal tolls, airport surcharges, or processing fees for split payments. If you wish, you may also choose to pay a Tip to the driver directly or via the use of Etransit in-App Payment.
                            </p>
                            <h5 class="mb-3"><li>Promotional Codes</li></h5>
                            <p>
                                2.1 Etransit may send you promotional codes on a per-promotion basis. Promotional code credit can be applied towards payment on completion of a ride or other features or benefits related to the service and/or a Third Party’s service and are subject to any additional terms that are established on a per promotional code basis. Expiration dates of promo codes will be reflected in-app once you have applied the promo code to your account.
                            </p>
                            <p>
                                2.2, A promotional code credit only applies on a per-trip basis and cannot carry over to the next ride/ trip and therefore will be forfeited. Only one promotional code may be applied per trip.
                            </p>
                            <p>Etransit reserves the right to cancel any promotional code at any time for any reason.</p>
                            <h5 class="mb-3"><li>Etransit in-App Payment</li></h5>
                            <p>3.1 Depending on the payment options supported for the given location of the journey, You can pay for the transport services with a card, mobile carrier billing, or other payment and when available through Etransit App. By providing Etransit in-App Payment service, Etransit acts as a commercial agent for the providers of transport services. Every transporter has authorized Etransit as their commercial agent for the mediation of the conclusion of contracts between the driver and the passenger, including the power to accept payments from the passengers and to forward the payments to the driver. Your obligation to the provider of the transport service will be fulfilled when the payment order is given to transfer funds to Etransit bank account. You, as a passenger are responsible for ensuring that the payment takes place and ensuring that sufficient funds are available.</p>
                            <p>3.2 When making payments by Etransit in-App Payment, Etransit receives your payments and forwards the money to the transporter. Etransit may ask for additional data from you to verify the payment methods.</p>
                            <p>3.3 When making payments by Etransit in-App Payment for transport services, Etransit is not responsible for possible third-party payment costs (e.g mobile operators, bank fees). These service providers may charge you additional fees when processing payments in connection with the Etransit in-App Payment. Etransit is not responsible for any such fees and disclaims all liability in this regard. Your payment method may also be subject to additional terms and conditions imposed by the applicable third-party payment service provider; please review these terms and conditions before using your payment method.</p>
                            <p> 3.4 Etransit will be responsible for the functioning of Etransit in-App Payment and provide support in resolving problems. The resolution of disputes related to Etransit in-App Payment also takes place through us. For payment support services please contact: hello@Etransitafrica.com Inquiries submitted by e-mail or Etransit App will receive a response within one business day. </p>
                            <p>Etransit will resolve Etransit in-App Payment-related complaints and applications within two business days.</p>
                            <h5 class="mb-3"><li>Ordering and canceling transport services</li></h5>
                            <p>4.1 If you order a transport service and the transporter has agreed to undertake the work then the transport service is considered to be ordered.</p>
                            <p>4.2 Cancelling an already ordered and paid transport may result in part or 100% of payment forfeiture.</p>
                            <p>4.3 When the driver notifies the passenger about the arrival of the vehicle to its destination and the passenger or people for whom the transport was ordered do not arrive at the vehicle within the certain period as specified in the Etransit app, the request will be deemed canceled. Please note that Etransit is not responsible for such situations.</p>
                            <p>4.4 Once the driver arrives and sends you a notification that he/she has arrived, your session has started.</p>
                            <p>4.5 If you have requested transport services using the Etransit app and cause damage to the driver’s vehicle or its furnishing (among else, by blemishing or staining the vehicle or causing the vehicle to stink), you would be required to pay a penalty fee and required to pay for any damages. If you do not pay the penalty and/or compensate for the damage, Etransit may pursue the claims on behalf of the provider of the transport service.</p>
                            <p>4.6 A day is regarded as 12 hours i.e. 6 am-6 pm. And any hour spent after 6 pm is regarded as overtime and liable to extra charges</p>
                            <h5 class="mb-3"><li>License to use Etransit app</li></h5>
                            <p>5.1 As long as you comply with these General Terms and Conditions, we agree to grant you a royalty-free, revocable, non-exclusive, right to access and use the Etransit app in accordance with these General Terms and Conditions, the Privacy Notice, and the applicable app-store terms. You may not transfer or sub-license this right to use the Etransit app. In the event that your trip on Etransit app is canceled, the corresponding non-exclusive license will also be canceled.</p>
                            <h5 class="mb-3"><li>Liability</li></h5>
                            <p>6.1 As the Etransit app is an information society service (a means of communication) between users and transporters, we cannot guarantee or take any responsibility for the quality or the absence of defects in the provision of transport services. As the usage of Etransit app for requesting transport services depends on the behavior of the drivers, Etransit does not guarantee that you will always have offers available for the provision of transport services.</p>
                            <p>6.2 The consumer’s right to refund is not applied to Etransit app on all orders. Requesting a refund from the transport service does not withdraw you from the agreement in the course of which the provision of the transport service was ordered.</p>
                            <p>6.3 The Etransit app is provided on an "as is" and “as available” basis. Etransit does not represent, warrant,, or guarantee that access to Etransit app will be uninterrupted or error-free. In case of any faults in the software, we will endeavor to correct them as soon as possible, but please keep in mind that the functioning of the app may be restricted due to occasional technical errors and we are not able to guarantee that the app will function at all times, for example, a public emergency may result in a service interruption.</p>
                            <p>6.4 Etransit, its representatives, directors, and employees are not liable for any loss or damage that you may incur as a result of using Etransit app or relying on, the journey contracted for through the Etransit app, including but not limited to:</p>
                            <p>6.4.1. any direct or indirect property damage or monetary loss;</p>
                            <p>6.4.2. loss of business, contracts, contacts, goodwill, reputation, and any loss that may arise from interruption of the business;
                            <p>6.4.3. loss or inaccuracy of data; and</p>
                            <p>6.4.4. any other type of loss or damage.</p>
                            <p>6.5 You will have the right to claim damages only if Etransit has deliberately violated the contract. Etransit will not be liable for the actions or inactions of the driver and will not be liable for damages that the driver causes to the passengers.</p>
                            <p>6.6 You agree to fully indemnify and hold Etransit, their affiliate companies, representatives, employees, and directors harmless from any claims or losses (including liabilities, damages, costs, and expenses of any nature) that they suffer as a result of your use of the Etransit app (including the journeys you obtain through your use of the Etransit app).</p>
                            <p>6.7 Etransit may immediately end your use of the Etransit app if you breach these General Terms and Conditions or if we consider it necessary to protect the integrity of Etransit or the safety of drivers.</p>
                            <h5 class="mb-3"><li>Good practice using the Etransit app</li></h5>
                            <p>7.1 Any issues with defects or quality of the transport services will be resolved in accordance with the rules and regulations of the transport service provider or the relevant public authority.</p>
                            <p>7.2 We ask you to fill out a feedback form in the Etransit app. This enables us to offer suggestions to the drivers for improving the quality of their service.</p>
                            <p>7.3 We expect that you use Etransit app in good faith and be respectful of the drivers who offer their services through Etransit app. Etransit retains the right to close your account if you have violated the terms set out in this General Terms and Conditions or if your activities are malicious, i.e. withholding payment for the provision of the transport service, fraud, being disrespectful towards the drivers, etc. In these cases, your Etransit app account may be revoked without prior notice.</p>
                            <p>7.4 Etransit will make every effort to ensure that only transporters, who have integrity and are respectful of their profession and passengers, use the Etransit app. However, we are in no position to guarantee that every provider of transport services, located by the Etransit app, satisfies the aforementioned criteria at all times. If you experience objectionable transport service, please notify the company responsible for the service, a supervisory authority, or our customer support.</p>
                            <h5 class="mb-3"><li>Amendments to the General Terms and Conditions</li></h5>
                            <p>If any substantial amendments are made to the General Terms and Conditions, then you will be notified by e-mail or Etransit app notifications. If you continue using Etransit app, you will be deemed to accept the amendments.</p>
                            <h5 class="mb-3"><li>Final Provisions</li></h5>
                            <p>The General Terms and Conditions will be governed by and construed and enforced in accordance with the laws of the federal republic of Nigeria. If the respective dispute resulting from General Terms or Agreement could not be settled by the negotiations, then the dispute will be finally solved in a Nigerian court.</p>
                        </ol>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End About Section -->

@endsection
