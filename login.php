<?php include 'includes/header.php'; ?>

<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="glass-panel w-full max-w-md p-8 rounded-2xl">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Welcome Back</h2>
            <p class="text-gray-400 mt-2">Sign in to access your account</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-3 rounded-lg mb-6 text-sm text-center">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-500/10 border border-green-500/50 text-green-500 p-3 rounded-lg mb-6 text-sm text-center">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>

        <form action="actions/auth_code.php" method="POST" class="space-y-6">
            <input type="hidden" name="action" value="login">
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                <input type="email" name="email" required 
                    class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                    placeholder="you@example.com">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required 
                        class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors pr-10"
                        placeholder="••••••••">
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" class="rounded bg-[#101022] border-white/10 text-primary focus:ring-primary">
                    <span class="text-gray-400">Remember me</span>
                </label>
                <a href="#" class="text-primary hover:text-primary-light transition-colors">Forgot password?</a>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 rounded-xl shadow-lg shadow-primary/25 transition-all transform active:scale-[0.98]">
                Sign In
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-400">
            Don't have an account? 
            <a href="register.php" class="text-primary hover:text-primary-light font-medium transition-colors">Create one</a>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('span');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility_off';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility';
    }
}
</script>

<?php include 'includes/footer.php'; ?>