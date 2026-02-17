<?php include 'includes/header.php'; ?>

<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="glass-panel w-full max-w-md p-8 rounded-2xl">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Create Account</h2>
            <p class="text-gray-400 mt-2">Join TalentNest today</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-3 rounded-lg mb-6 text-sm text-center">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="actions/auth_code.php" method="POST" class="space-y-5">
            <input type="hidden" name="action" value="register">
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Full Name / Company Name</label>
                <input type="text" name="name" required 
                    class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                    placeholder="John Doe">
            </div>

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

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">I am a...</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="seeker" class="peer sr-only" checked>
                        <div class="text-center py-3 rounded-xl border border-white/10 bg-[#101022] text-gray-400 peer-checked:bg-primary/20 peer-checked:border-primary peer-checked:text-white transition-all">
                            Job Seeker
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="employer" class="peer sr-only">
                        <div class="text-center py-3 rounded-xl border border-white/10 bg-[#101022] text-gray-400 peer-checked:bg-primary/20 peer-checked:border-primary peer-checked:text-white transition-all">
                            Employer
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 rounded-xl shadow-lg shadow-primary/25 transition-all transform active:scale-[0.98]">
                Create Account
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-400">
            Already have an account? 
            <a href="login.php" class="text-primary hover:text-primary-light font-medium transition-colors">Sign in</a>
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