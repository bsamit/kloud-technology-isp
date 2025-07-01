@extends('home')
@section('title', 'Email Settings')
@section('dashboard_content')
<div class="page-body">
    <div class="container-fluid px-4">
        <div class="card my-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-envelope me-1"></i>
                        Email Settings
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('general-settings.email-settings.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mail Mailer</label>
                                <select name="mail_mailer" class="form-select @error('mail_mailer') is-invalid @enderror" required>
                                    <option value="smtp" {{ old('mail_mailer', $settings->mail_mailer ?? '') == 'smtp' ? 'selected' : '' }}>SMTP</option>
                                    <option value="sendmail" {{ old('mail_mailer', $settings->mail_mailer ?? '') == 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                                </select>
                                @error('mail_mailer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mail Host</label>
                                <input type="text" 
                                       name="mail_host" 
                                       class="form-control @error('mail_host') is-invalid @enderror" 
                                       value="{{ old('mail_host', $settings->mail_host ?? '') }}" 
                                       placeholder="e.g., smtp.gmail.com"
                                       required>
                                @error('mail_host')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mail Port</label>
                                <input type="number" 
                                       name="mail_port" 
                                       class="form-control @error('mail_port') is-invalid @enderror" 
                                       value="{{ old('mail_port', $settings->mail_port ?? '') }}" 
                                       placeholder="e.g., 587"
                                       required>
                                @error('mail_port')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mail Username</label>
                                <input type="text" 
                                       name="mail_username" 
                                       class="form-control @error('mail_username') is-invalid @enderror" 
                                       value="{{ old('mail_username', $settings->mail_username ?? '') }}" 
                                       placeholder="Your email address"
                                       required>
                                @error('mail_username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mail Password</label>
                                <input type="password" 
                                       name="mail_password" 
                                       class="form-control @error('mail_password') is-invalid @enderror" 
                                       value="{{ old('mail_password', $settings->mail_password ?? '') }}" 
                                       placeholder="Your email password or app password"
                                       required>
                                @error('mail_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">For Gmail, use App Password if 2FA is enabled.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mail Encryption</label>
                                <select name="mail_encryption" class="form-select @error('mail_encryption') is-invalid @enderror" required>
                                    <option value="tls" {{ old('mail_encryption', $settings->mail_encryption ?? '') == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ old('mail_encryption', $settings->mail_encryption ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                </select>
                                @error('mail_encryption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mail From Address</label>
                                <input type="email" 
                                       name="mail_from_address" 
                                       class="form-control @error('mail_from_address') is-invalid @enderror" 
                                       value="{{ old('mail_from_address', $settings->mail_from_address ?? '') }}" 
                                       placeholder="noreply@yourcompany.com"
                                       required>
                                @error('mail_from_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mail From Name</label>
                                <input type="text" 
                                       name="mail_from_name" 
                                       class="form-control @error('mail_from_name') is-invalid @enderror" 
                                       value="{{ old('mail_from_name', $settings->mail_from_name ?? '') }}" 
                                       placeholder="Your Company Name"
                                       required>
                                @error('mail_from_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Save Settings
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <input type="email" 
                                       id="test_email" 
                                       class="form-control me-2" 
                                       placeholder="Enter email to test">
                                <button type="button" 
                                        class="btn btn-info" 
                                        onclick="sendTestEmail()">
                                    <i class="fas fa-paper-plane me-1"></i>
                                    Send Test Email
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function sendTestEmail() {
        const testEmail = document.getElementById('test_email').value;
        if (!testEmail) {
            alert('Please enter an email address for testing');
            return;
        }

        // Show loading state
        const button = event.target;
        const originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Sending...';

        fetch('{{ route("general-settings.email-settings.test") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ test_email: testEmail })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            alert('Failed to send test email: ' + error.message);
        })
        .finally(() => {
            // Restore button state
            button.disabled = false;
            button.innerHTML = originalText;
        });
    }
</script>
@endsection
