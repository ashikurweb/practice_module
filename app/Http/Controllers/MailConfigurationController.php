<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class MailConfigurationController extends Controller
{
    /**
     * 显示邮件配置表单
     */
    public function index()
    {
        // 从.env文件中读取当前配置
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
     * 处理表单提交
     */
    public function update(Request $request)
    {
        $action = $request->input('action');
        
        // 验证规则
        $rules = [
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|numeric',
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

        if ($action === 'save') {
            // 保存到.env文件
            $this->updateEnvFile($request->all());
            // 清除配置缓存
            Artisan::call('config:clear');
            return redirect()->route('admin.mail.configuration')->with('success', 'Mail configuration saved successfully!');
        } elseif ($action === 'test') {
            // 测试邮件连接
            $result = $this->testMailConnection($request->all());
            if ($result) {
                return redirect()->back()->with('success', 'Test connection successful!')->withInput();
            } else {
                return redirect()->back()->with('error', 'Test connection failed. Please check your credentials.')->withInput();
            }
        }

        return redirect()->back();
    }

    /**
     * 更新.env文件
     */
    private function updateEnvFile(array $data)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        // 将表单字段名转换为.env中的键名
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
            // 如果.env文件中已有该键，则替换，否则追加
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
     * 测试邮件连接
     */
    private function testMailConnection(array $data)
    {
        try {
            // 临时配置邮件设置（不修改.env，只用于本次测试）
            config([
                'mail.mailers.smtp.host' => $data['mail_host'],
                'mail.mailers.smtp.port' => $data['mail_port'],
                'mail.mailers.smtp.encryption' => $data['mail_encryption'],
                'mail.mailers.smtp.username' => $data['mail_username'],
                'mail.mailers.smtp.password' => $data['mail_password'],
                'mail.from.address' => $data['mail_from_address'],
                'mail.from.name' => $data['mail_from_name'],
            ]);

            // 创建一个测试邮件
            Mail::raw('This is a test email.', function ($message) use ($data) {
                $message->to($data['mail_from_address'])
                    ->subject('Test Email');
            });

            return true;
        } catch (\Exception $e) {
            // 记录错误日志
            \Log::error('Mail test connection failed: ' . $e->getMessage());
            return false;
        }
    }
}