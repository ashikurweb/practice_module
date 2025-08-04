<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class MailConfigurationController extends Controller
{
    /**
     * Mail Configuration Form
     */
    public function index()
    {
        // Read current configuration from .env file
        $values = [
            'MAIL_MAILER' => env('MAIL_MAILER'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        ];

        return view('admin.settings.mail.index', compact('values'));
    }

    /**
     * Handle form submission
     */
    public function update(Request $request)
    {
        $action = $request->input('action');
        
        // Validation rules
        $rules = [
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric|between:1,65535',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If test button is clicked
        if ($action === 'test') {
            // Check if saved
            $currentEnv = [
                'MAIL_MAILER' => env('MAIL_MAILER'),
                'MAIL_HOST' => env('MAIL_HOST'),
                'MAIL_PORT' => env('MAIL_PORT'),
                'MAIL_USERNAME' => env('MAIL_USERNAME'),
                'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
                'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
                'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
                'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
            ];

            $formData = [
                'MAIL_MAILER' => $request->mail_mailer,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
                'MAIL_FROM_NAME' => $request->mail_from_name,
            ];

            // Check if any empty value
            foreach ($formData as $key => $value) {
                if (empty($value)) {
                    return redirect()->back()
                        ->with('error', 'Please fill in all fields before testing.')
                        ->withInput();
                }
            }

            // Compare form data with .env data
            if ($currentEnv !== $formData) {
                return redirect()->back()
                    ->with('error', 'Please save your configuration first before testing.')
                    ->withInput();
            }
            
            // Check if mail credentials are valid
            if (!$this->validateMailCredentials($request->all())) {
                return redirect()->back()
                    ->with('error', 'Invalid mail credentials. Please check your settings.')
                    ->withInput();
            }
            
            // Test mail connection
            $result = $this->testMailConnection($request->all());
            if ($result) {
                return redirect()->back()
                    ->with('success', 'Test connection successful! Email sent to ' . $request->mail_from_address)
                    ->withInput();
            } else {
                return redirect()->back()
                    ->with('error', 'Test connection failed. Please check your credentials and try again.')
                    ->withInput();
            }
        }
        
        // If save button is clicked
        if ($action === 'save') {
            // Check if mail credentials are valid
            if (!$this->validateMailCredentials($request->all())) {
                return redirect()->back()
                    ->with('error', 'Invalid mail credentials. Please check your settings.')
                    ->withInput();
            }
            
            // Update .env file
            $this->updateEnvFile($request->all());
            Artisan::call('config:clear');
            
            return redirect()->route('admin.mail.configuration')
                ->with('success', 'Mail configuration saved successfully!');
        }

        return redirect()->back();
    }

    /**
     * Validate mail credentials
     */
    private function validateMailCredentials(array $data)
    {
        // Check if mailer type is valid
        $validMailers = ['smtp', 'sendmail', 'mailgun', 'ses', 'postmark'];
        if (!in_array(strtolower($data['mail_mailer']), $validMailers)) {
            return false;
        }
        
        // Check if encryption type is valid
        $validEncryption = ['tls', 'ssl', ''];
        if (!in_array(strtolower($data['mail_encryption']), $validEncryption)) {
            return false;
        }
        
        // Additional validation for SMTP
        if (strtolower($data['mail_mailer']) === 'smtp') {
            // Check if host format is valid
            if (!filter_var(gethostbyname($data['mail_host']), FILTER_VALIDATE_IP)) {
                return false;
            }
            
            // Check if port range is valid
            $port = (int)$data['mail_port'];
            if ($port < 1 || $port > 65535) {
                return false;
            }
            
            // Check if username and password are empty
            if (empty($data['mail_username']) || empty($data['mail_password'])) {
                return false;
            }
        }
        
        // Check if form address is valid
        if (!filter_var($data['mail_from_address'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Check if form name is empty
        if (empty($data['mail_from_name'])) {
            return false;
        }
        
        return true;
    }

    /**
     * Update .env file
     */
    private function updateEnvFile(array $data)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $envKeys = [
            'mail_mailer' => 'MAIL_MAILER',
            'mail_host' => 'MAIL_HOST',
            'mail_port' => 'MAIL_PORT',
            'mail_username' => 'MAIL_USERNAME',
            'mail_password' => 'MAIL_PASSWORD',
            'mail_encryption' => 'MAIL_ENCRYPTION',
            'mail_from_address' => 'MAIL_FROM_ADDRESS',
            'mail_from_name' => 'MAIL_FROM_NAME',
        ];

        foreach ($envKeys as $formKey => $envKey) {
            if (strpos($str, $envKey) !== false) {
                $str = preg_replace(
                    "/^{$envKey}=.*/m",
                    "{$envKey}=" . $data[$formKey],
                    $str
                );
            } else {
                $str .= "\n{$envKey}=" . $data[$formKey];
            }
        }

        file_put_contents($envFile, $str);
    }

    /**
     * Test mail connection
     */
    private function testMailConnection(array $data)
    {
        try {
            // Set temporary configuration for testing
            config([
                'mail.mailers.smtp.host' => $data['mail_host'],
                'mail.mailers.smtp.port' => $data['mail_port'],
                'mail.mailers.smtp.encryption' => $data['mail_encryption'],
                'mail.mailers.smtp.username' => $data['mail_username'],
                'mail.mailers.smtp.password' => $data['mail_password'],
                'mail.from.address' => $data['mail_from_address'],
                'mail.from.name' => $data['mail_from_name'],
            ]);

            // Send test email
            Mail::raw('This is a test email to verify your SMTP configuration.', function ($message) use ($data) {
                $message->to($data['mail_from_address'])
                    ->subject('SMTP Configuration Test');
            });

            return true;
        } catch (\Exception $e) {
            \Log::error('Mail test connection failed: ' . $e->getMessage());
            return false;
        }
    }
}