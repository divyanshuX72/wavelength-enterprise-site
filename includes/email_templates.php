<?php
/**
 * Email Templates for Wavelength Enterprises
 */

function getEmailHeader() {
    return '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
            .header { background: #1a1410; color: #d7c2ad; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
            .header h1 { margin: 0; font-size: 24px; }
            .content { padding: 20px; }
            .footer { text-align: center; padding: 20px; font-size: 12px; color: #777; border-top: 1px solid #eee; }
            .label { font-weight: bold; color: #555; }
            .highlight { color: #c8923a; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Wavelength Enterprises</h1>
            </div>
            <div class="content">
    ';
}

function getEmailFooter() {
    return '
            </div>
            <div class="footer">
                <p>&copy; ' . date('Y') . ' Wavelength Enterprises. All rights reserved.</p>
                <p>Custom Furniture & Interior Solutions</p>
            </div>
        </div>
    </body>
    </html>
    ';
}

function getAdminVisitNotificationBody($data) {
    return getEmailHeader() . '
        <h2>New Visit Scheduled</h2>
        <p>A new site visit has been requested via the website.</p>
        
        <h3>Booking Details</h3>
        <p><span class="label">Consultation Type:</span> ' . ucfirst($data['type']) . '</p>
        <p><span class="label">Date:</span> ' . $data['date'] . '</p>
        <p><span class="label">Time:</span> ' . $data['time'] . '</p>
        
        <h3>Location</h3>
        <p><span class="label">Type:</span> ' . ucfirst($data['location_type']) . '</p>
        <p><span class="label">Address:</span><br>' . nl2br(htmlspecialchars($data['address'])) . '</p>
        <p><span class="label">Landmark:</span> ' . htmlspecialchars($data['landmark']) . '</p>
        <p><span class="label">Pincode:</span> ' . htmlspecialchars($data['pincode']) . '</p>
        ' . (!empty($data['google_map']) ? '<p><span class="label">Google Map:</span> <a href="' . htmlspecialchars($data['google_map']) . '">View Map</a></p>' : '') . '
    ' . getEmailFooter();
}

function getAdminQuoteNotificationBody($data) {
    return getEmailHeader() . '
        <h2>New Quote Request</h2>
        <p>A new custom quote has been requested.</p>
        
        <h3>Client Details</h3>
        <p><span class="label">Name:</span> ' . htmlspecialchars($data['name']) . '</p>
        <p><span class="label">Email:</span> ' . htmlspecialchars($data['email']) . '</p>
        <p><span class="label">Phone:</span> ' . htmlspecialchars($data['phone']) . '</p>
        
        <h3>Project Details</h3>
        <h3>Project Details</h3>
        <p><span class="label">Product:</span> <span class="highlight">' . htmlspecialchars($data['product'] ?? $data['furniture_type'] ?? 'N/A') . '</span></p>
        ' . (!empty($data['room_type']) ? '<p><span class="label">Room Type:</span> ' . htmlspecialchars($data['room_type']) . '</p>' : '') . '
        
        ' . ((!empty($data['length']) || !empty($data['height']) || !empty($data['depth'])) ? '
        <h3>Dimensions</h3>
        <p>
            ' . (!empty($data['length']) ? 'L: ' . htmlspecialchars($data['length']) . 'ft ' : '') . '
            ' . (!empty($data['height']) ? 'H: ' . htmlspecialchars($data['height']) . 'ft ' : '') . '
            ' . (!empty($data['depth']) ? 'D: ' . htmlspecialchars($data['depth']) . 'ft ' : '') . '
        </p>' : '') . '
        
        ' . (!empty($data['budget']) ? '<p><span class="label">Budget:</span> ₹' . htmlspecialchars($data['budget']) . '</p>' : '') . '
        
        <h3>Message</h3>
        <p>' . nl2br(htmlspecialchars($data['message'])) . '</p>
    ' . getEmailFooter();
}

function getUserVisitConfirmationBody($data) {
    return getEmailHeader() . '
        <h2>Visit Confirmed!</h2>
        <p>Dear Customer,</p>
        <p>Thank you for scheduling a visit with Wavelength Enterprises. We have received your request and our team will be there to assist you.</p>
        
        <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #c8923a; margin: 20px 0;">
            <p style="margin:0"><strong>Date:</strong> ' . $data['date'] . '</p>
            <p style="margin:0"><strong>Time:</strong> ' . $data['time'] . '</p>
            <p style="margin:0"><strong>Type:</strong> ' . ucfirst($data['type']) . '</p>
        </div>
        
        <p>If you need to reschedule, please contact us at +91 93731 54925.</p>
    ' . getEmailFooter();
}

function getUserQuoteConfirmationBody($data) {
    return getEmailHeader() . '
        <h2>Request Received</h2>
        <p>Dear ' . htmlspecialchars($data['name']) . ',</p>
        <p>Thank you for contacting Wavelength Enterprises. We have received your quote request for <strong>' . htmlspecialchars($data['product']) . '</strong>.</p>
        
        <p>Our design team will review your requirements and get back to you with a preliminary estimate within 24 hours.</p>
        
        <p>Best regards,<br>The Wavelength Team</p>
    ' . getEmailFooter();
}
?>
