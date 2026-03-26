<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        h2 { color: #1a1a1a; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; }
        .field { margin: 12px 0; }
        .label { font-weight: bold; color: #555; font-size: 13px; text-transform: uppercase; }
        .value { margin-top: 4px; font-size: 15px; }
        .message-box { background: #f9fafb; border-left: 4px solid #3b82f6; padding: 12px 16px; margin-top: 4px; white-space: pre-wrap; }
        .footer { margin-top: 30px; font-size: 12px; color: #999; border-top: 1px solid #e5e7eb; padding-top: 10px; }
    </style>
</head>
<body>
    <h2>Nova poruka sa kontakt forme</h2>

    <div class="field">
        <div class="label">Ime</div>
        <div class="value">{{ $question->name }}</div>
    </div>

    @if($question->firm)
    <div class="field">
        <div class="label">Firma</div>
        <div class="value">{{ $question->firm }}</div>
    </div>
    @endif

    <div class="field">
        <div class="label">Email</div>
        <div class="value"><a href="mailto:{{ $question->email }}">{{ $question->email }}</a></div>
    </div>

    @if($question->phone)
    <div class="field">
        <div class="label">Telefon</div>
        <div class="value">{{ $question->phone }}</div>
    </div>
    @endif

    <div class="field">
        <div class="label">Poruka</div>
        <div class="message-box">{{ $question->message }}</div>
    </div>

    <div class="footer">
        Poruka primljena: {{ now()->format('d.m.Y. H:i') }} &mdash; Maxter
    </div>
</body>
</html>
