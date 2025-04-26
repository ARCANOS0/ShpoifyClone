<?php
require_once __DIR__ . '/../admin/config/db.php';
require_once __DIR__ . '/functions.php';

// Check if user is logged in
if (!isLoggedIn()) {
    redirect('login');
}

$user = getCurrentUser($pdo);
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address']
    ];
    
    if (updateUserData($user['id'], $data, $pdo)) {
        $message = '<div class="alert alert-success">تم تحديث البيانات بنجاح</div>';
        $user = getCurrentUser(); // Refresh user data
    } else {
        $message = '<div class="alert alert-danger">حدث خطأ أثناء تحديث البيانات</div>';
    }
}
?>

<div class="profile-container">
    <h2>الملف الشخصي</h2>
    
    <?php echo $message; ?>
    
    <div class="profile-content">
        <div class="profile-info">
            <h3>معلومات الحساب</h3>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">اسم المستخدم</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">رقم الهاتف</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
                </div>
                
                <div class="form-group">
                    <label for="address">العنوان</label>
                    <textarea id="address" name="address"><?php echo htmlspecialchars($user['address']); ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
            </form>
        </div>
        
        <div class="profile-stats">
            <h3>إحصائيات الحساب</h3>
            <ul>
                <li>تاريخ التسجيل: <?php echo date('Y/m/d', strtotime($user['created_at'])); ?></li>
                <li>آخر تحديث: <?php echo date('Y/m/d', strtotime($user['updated_at'])); ?></li>
            </ul>
        </div>
    </div>
</div>

<style>
.profile-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.profile-content {
    display: flex;
    gap: 20px;
    margin-top: 20px;
}

.profile-info {
    flex: 2;
}

.profile-stats {
    flex: 1;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.form-group textarea {
    height: 100px;
    resize: vertical;
}

.btn-primary {
    background: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-primary:hover {
    background: #0056b3;
}

.alert {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style> 