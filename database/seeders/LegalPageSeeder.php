<?php

namespace Database\Seeders;

use App\Models\LegalPage;
use Illuminate\Database\Seeder;

class LegalPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LegalPage::updateOrCreate(
            ['slug' => LegalPage::TERMS],
            [
                'title'   => 'Terms of Use',
                'content' => $this->defaultTerms(),
                'version' => 1,
            ]
        );

        LegalPage::updateOrCreate(
            ['slug' => LegalPage::PRIVACY],
            [
                'title'   => 'Privacy Policy',
                'content' => $this->defaultPrivacyPolicy(),
                'version' => 1,
            ]
        );
    }

    private function defaultTerms(): string
    {
        return <<<'HTML'
<h2>1. Acceptance of Terms</h2>
<p>By creating an account or logging into the LMS / EDU Library Management System ("the System"), you agree to be bound by these Terms of Use. If you do not agree, please do not use the System.</p>

<h2>2. Eligibility</h2>
<p>The System is intended for use by registered students and authorized library staff of the institution. You must provide accurate registration information, including a valid student ID.</p>

<h2>3. Account Responsibilities</h2>
<p>You are responsible for maintaining the confidentiality of your login credentials and for all activity that occurs under your account. Notify the library administration immediately if you suspect unauthorized use of your account.</p>

<h2>4. Borrowing Rules</h2>
<p>Books issued through the System must be returned by the due date shown in your dashboard. Late returns may incur a fine as configured by the library. Damaged or lost books may be charged at the book's listed price.</p>

<h2>5. Acceptable Use</h2>
<p>You agree not to misuse the System, including attempting unauthorized access to other accounts, submitting false information, or interfering with the System's normal operation.</p>

<h2>6. Changes to These Terms</h2>
<p>The library administration may update these Terms from time to time. Continued use of the System after changes are posted constitutes acceptance of the revised Terms.</p>

<h2>7. Contact</h2>
<p>Questions about these Terms can be directed to your library administrator.</p>
HTML;
    }

    private function defaultPrivacyPolicy(): string
    {
        return <<<'HTML'
<h2>1. Information We Collect</h2>
<p>When you register for the LMS / EDU Library Management System, we collect information such as your name, student ID, email address, phone number, department, semester, and address.</p>

<h2>2. How We Use Your Information</h2>
<p>Your information is used to manage your library account, process book issues and returns, send due-date and overdue notifications, and communicate important library updates.</p>

<h2>3. Data Storage</h2>
<p>Your information is stored securely in the library's database and is accessible only to authorized library administrators.</p>

<h2>4. Sharing of Information</h2>
<p>We do not sell or share your personal information with third parties, except where required by institutional policy or law.</p>

<h2>5. Notifications</h2>
<p>With your account settings, the System may send you email notifications regarding due dates, fines, or account updates.</p>

<h2>6. Your Rights</h2>
<p>You may request to review or update your personal information at any time through your profile settings, or by contacting the library administration.</p>

<h2>7. Changes to This Policy</h2>
<p>This Privacy Policy may be updated periodically. Significant changes will be communicated through the System.</p>
HTML;
    }
}
