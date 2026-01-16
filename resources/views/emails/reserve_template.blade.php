<div style="font-family: 'Playfair Display', serif; color: #333; line-height: 1.6;">
    <h2 style="color: #6d6d18; border-bottom: 2px solid #6d6d18; padding-bottom: 10px;">
        New Booking Inquiry
    </h2>
    <p>You have received a new reservation request from your website.</p>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 8px; font-weight: bold; width: 150px;">Guest Name:</td>
            <td style="padding: 8px;">{{ $formData['full_name'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; font-weight: bold;">Phone:</td>
            <td style="padding: 8px;">{{ $formData['phone'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; font-weight: bold;">Room Type:</td>
            <td style="padding: 8px;">{{ $formData['room_type'] }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; font-weight: bold;">Guests:</td>
            <td style="padding: 8px;">{{ $formData['guests'] }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 8px; font-weight: bold;">Check-in:</td>
            <td style="padding: 8px;">{{ $formData['check_in'] }}</td>
        </tr>
        <tr style="background-color: #f9f9f9;">
            <td style="padding: 8px; font-weight: bold;">Check-out:</td>
            <td style="padding: 8px;">{{ $formData['check_out'] }}</td>
        </tr>
    </table>

    <p style="margin-top: 20px; font-size: 12px; color: #777;">
        Sent from Bandipur Eco Hotel Booking System.
    </p>
</div>
