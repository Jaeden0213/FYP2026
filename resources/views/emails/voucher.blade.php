<h2>Your Voucher</h2>

<p>Hello {{ $user->name ?? 'User' }},</p>

<p>Your voucher is ready to use.</p>

<p>
    Reward:
    <strong>{{ $redemption->storeItem->name ?? 'Reward Item' }}</strong>
</p>

<p>Please present this QR code when redeeming your voucher:</p>

<p>
    <img src="{{ $message->embed($qrPath) }}" alt="Voucher QR Code" style="max-width: 220px; border: 1px solid #ddd; border-radius: 8px;">
</p>

<p>The QR code is also attached to this email for convenience.</p>

<p>Thank you for using TaskFlow.</p>