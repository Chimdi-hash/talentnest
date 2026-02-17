<?php 
include 'includes/header.php'; 
require_once 'includes/functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'employer') {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>

<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="glass-panel rounded-2xl p-8">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-white">Post a New Job</h2>
            <p class="text-gray-400 mt-2">Find the best talent for your company</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-3 rounded-lg mb-6 text-sm text-center">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="actions/job_actions.php" method="POST" class="space-y-6">
            <input type="hidden" name="action" value="post_job">
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Job Title</label>
                <input type="text" name="title" required 
                    class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                    placeholder="e.g. Senior Product Designer">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                    <input type="text" name="location" required 
                        class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                        placeholder="e.g. Port Harcourt, Remote">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Job Type</label>
                    <select name="job_type" required 
                        class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Salary Range (Monthly)</label>
                <input type="text" name="salary_range" 
                    class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                    placeholder="e.g. 200000 or Negotiable">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Job Description</label>
                <textarea name="description" required rows="6"
                    class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                    placeholder="Describe the role, responsibilities, and requirements..."></textarea>
            </div>

            <div class="flex justify-end gap-4">
                <a href="employer_dashboard.php" class="px-6 py-3 rounded-xl border border-white/10 text-white hover:bg-white/5 transition-colors">Cancel</a>
                <button type="submit" class="bg-primary hover:bg-primary-light text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-primary/25 transition-all transform active:scale-[0.98]">
                    Post Job
                </button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>