<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Overdue Book Reminder</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background-color: #f4f6f9; margin: 0; padding: 24px;">

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">

        <tr>
            <td style="background-color: #4e73df; padding: 20px 30px;">
                <h1 style="color: #ffffff; font-size: 18px; margin: 0;">
                    Library Management System
                </h1>
            </td>
        </tr>

        <tr>
            <td style="padding: 30px;">
                <p style="font-size: 15px; color: #333;">
                    Dear {{ $issue->user->name ?? 'Student' }},
                </p>

                <p style="font-size: 15px; color: #333;">
                    Our records show that the book you borrowed is now <strong>overdue</strong>.
                    Please return it to the library as soon as possible to avoid further fines.
                </p>

                <table role="presentation" width="100%" cellpadding="8" cellspacing="0" style="border-collapse: collapse; margin: 20px 0; font-size: 14px;">
                    <tr>
                        <td style="border: 1px solid #e3e6f0; background: #f8f9fc; font-weight: bold;">Book Title</td>
                        <td style="border: 1px solid #e3e6f0;">{{ $issue->book->title ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e3e6f0; background: #f8f9fc; font-weight: bold;">Issue Date</td>
                        <td style="border: 1px solid #e3e6f0;">
                            {{ $issue->issue_date ? \Carbon\Carbon::parse($issue->issue_date)->format('d M Y') : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e3e6f0; background: #f8f9fc; font-weight: bold;">Due Date</td>
                        <td style="border: 1px solid #e3e6f0;">
                            {{ $issue->return_deadline ? \Carbon\Carbon::parse($issue->return_deadline)->format('d M Y') : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e3e6f0; background: #f8f9fc; font-weight: bold;">Days Overdue</td>
                        <td style="border: 1px solid #e3e6f0; color: #e74a3b; font-weight: bold;">
                            {{ $overdueDays }} day(s)
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e3e6f0; background: #f8f9fc; font-weight: bold;">Fine Accrued</td>
                        <td style="border: 1px solid #e3e6f0; color: #e74a3b; font-weight: bold;">
                            ৳{{ number_format($fineAmount, 2) }}
                        </td>
                    </tr>
                </table>

                <p style="font-size: 15px; color: #333;">
                    Kindly return the book to the library desk at your earliest convenience.
                    If you have already returned this book, please disregard this notice.
                </p>

                <p style="font-size: 15px; color: #333; margin-top: 30px;">
                    Regards,<br>
                    Library Administration
                </p>
            </td>
        </tr>

        <tr>
            <td style="background: #f8f9fc; padding: 15px 30px; text-align: center; font-size: 12px; color: #858796;">
                This is an automated notice from the Library Management System. Please do not reply directly to this email.
            </td>
        </tr>

    </table>

</body>
</html>
