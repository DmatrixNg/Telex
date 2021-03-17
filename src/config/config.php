<?php

return [

    // "HMS_MESSAGES" => [
    "CANCELLATION" => [
        [
            "type" => "Cancellation request to Hotel",
            "to_hotel" => true, "hide_suggested" => true,
            "sms_template_id" => "55b75aeb9f35a5ac69582e2c",
            "email_template_id" => "55bb4252923c447666941a88",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
    ],
    "DELAY" => [
        [
            "type" => "Room not Available",
            "sms_template_id" => "55b754969f35a5ac69582e23",
            "email_template_id" => "55ba4695d792f94c2e3fb506",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Fully Booked",
            "sms_template_id" => "55b755169f35a5ac69582e24",
            "email_template_id" => "55ba4dd8d792f94c2e3fb512",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Hotel not Reachable",
            "sms_template_id" => "55b755cd9f35a5ac69582e25",
            "email_template_id" => "55ba5069d792f94c2e3fb516",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Hotel not Reachable FINAL",
            "sms_template_id" => "55b756c79f35a5ac69582e26",
            "email_template_id" => "55ba52b9d792f94c2e3fb51a",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Customer not Reachable",
            "sms_template_id" => "55b7571a9f35a5ac69582e27",
            "email_template_id" => "55ba5472d792f94c2e3fb51c",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
    ],
    "CONFIRMATION" => [
        [
            "type" => "Started",
            "email_template_id" => "55ba3ee69288add82183b381",
            "sms_template_id" => "55b667f851fd45c838e01b1d",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Confirmation Message",
            "email_template_id" => "55bb32c4923c447666941a79",
            "sms_template_id" => "55b758799f35a5ac69582e29",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Check In Confirmation",
            "email_template_id" => "5602b6c1ad21662b6cebbb78",
            "sms_template_id" => "5602c2d7ec8189b805745cf3",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Account Details",
            "sms_template_id" => "55b757cf9f35a5ac69582e28",
            "email_template_id" => "55ba5820d792f94c2e3fb520",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Reservation Request to Hotel",
            "to_hotel" => true,
            "hide_suggested" => true,
            "email_template_id" => "55bb3821923c447666941a7c",
            "sms_template_id" => "55b75a599f35a5ac69582e2b",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Payment Confirmation Message",
            "email_template_id" => "55bb46e8923c447666941a8a",
            "sms_template_id" => "55b75f199f35a5ac69582e2e",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Customer Information",
            "email_template_id" => "cf680cbc-d326-4a35-b4ea-2fb2f4b00356",
            "sms_template_id" => "8a974d72-3441-4e48-bbd6-c4ddf0c806ba",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
            "to_hotel" => true,
        ],
    ],
    "HOTEL UNAVAILABLE" => [
        [
            "type" => "Hotel Has Been Shut Down",
            "email_template_id" => "58176f6fa1e40c4c56ea7ea4",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
            "sms_template_id" => "582bff79f8dde4c96ae3988d",
        ],
        [
            "type" => "Hotel Is Under Renovation",
            "email_template_id" => "58176f6fa1e40c4c56ea7ea4",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
            "sms_template_id" => "582bff79f8dde4c96ae3988d",
        ],
    ],
    "STAY CONFIRMATION" => [
        [
            "type" => "Stay Confirmation - Client",
            "email_template_id" => "59b1cf7a9bd54aa323bd7390",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
    ],
    // "AFFILIATE CONFIRMATION"=> [
    //    ["type"=> "Affiliate Reservation Confirmation"]
    // ],
    "TRANSPORT REQUEST DETAILS" => [
        [
            "type" => "Cab Request Details",
            "to_slack" => true, "to_channel" => "cabs-flights-request",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "Flight Request Details",
            "to_slack" => true, "to_channel" => "cabs-flights-request",
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
    ],
    "PAYMENT" => [
        [
            "type" => "Payment Advice to hotel",
            "to_hotel" => true, "has_attachments" => true,
            "email_template_id" => "57775db2-7b60-43fa-a408-80550ee35880",
            "hide_suggested" => true, "modify_amount" => true, "custom_email" => true,
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "payment confirmation to Client",
            "to_hotel" => false, "has_attachments" => true,
            "email_template_id" => "55bb46e8923c447666941a8a",
            "hide_suggested" => true, "modify_amount" => true,
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
        [
            "type" => "payment confirmation to Hotel",
            "to_hotel" => true, "has_attachments" => true,
            "email_template_id" => "046a0f71-7a82-4819-82a1-fd96cd8b977a",
            "hide_suggested" => true, "modify_amount" => true,
            "sender_email" => "Hotel Reservations <reservations@hotels.ng>",
        ],
    ],
    "COLLECTION REMINDER" => [
        [
            "type" => "send first escalation",
            "email_template_id" => "58ef9a841fed23a93a6c6c47",
        ],
        [
            "type" => "send second escalation",
            "email_template_id" => "58ef9ff093f7dcb744a75bfa",
        ],
        [
            "type" => "send third escalation",
            "email_template_id" => "58efa23ffbbf9d50490eb1c4",
        ],
        [
            "type" => "send fourth escalation",
            "email_template_id" => "58efa43063890c8b4caf5594",
        ],
        [
            "type" => "send fifth escalation",
            "email_template_id" => "58efa61063890c8b4caf55ad",
        ],
        [
            "type" => "send sixth escalation",
            "email_template_id" => "58efa8f7f799250855574839",
        ],
        [
            "type" => "send seventh escalation",
            "email_template_id" => "58efab2e03d222305952447e",
        ],
        [
            "type" => "send last escalation",
            "email_template_id" => "58efafda3a311196619338a3",
        ],
    ],
    "COLLECTION INVOICE" => [
        [
            "type" => "receipt",
            "email_template_id" => "578e0eadf3bbe54d78b2ff4b",
        ],
        [
            "type" => "invoice",
            "sms_template_id" => "5787664458f66ba564b3da7a",
            "multiple_sms_template_id" => "a4f3d558-55e0-4fdf-bcbf-33119572a0dd",
            "email_template_id" => "563b82760054174a5ec345f6",
        ],
    ],

];
