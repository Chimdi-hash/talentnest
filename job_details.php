<?php 
include 'includes/header.php'; 
require_once 'includes/functions.php';

$job_id = $_GET['id'] ?? 0;
$job = getJobById($job_id);

if (!$job) {
    echo '<div class="text-center text-white py-20">Job not found.</div>';
    include 'includes/footer.php';
    exit;
}
?>

<div class="relative min-h-screen flex flex-col max-w-4xl mx-auto shadow-2xl bg-[#101022]">
    <!-- Main Content Scroll Area -->
    <main class="flex-grow pt-6 pb-32 px-5 relative z-10 flex flex-col gap-6">
        <!-- Hero Card -->
        <div class="glass-panel rounded-3xl p-6 flex flex-col items-center text-center shadow-glass relative overflow-hidden group">
            <!-- Decorative sheen -->
            <div class="absolute inset-0 bg-gradient-to-tr from-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"></div>
            <div class="w-24 h-24 rounded-2xl bg-[#1a1a2e] mb-5 p-1 border border-white/10 shadow-lg relative overflow-hidden">
                <?php if ($job['company_logo']): ?>
                    <img src="<?php echo htmlspecialchars($job['company_logo']); ?>" alt="Logo" class="w-full h-full object-cover rounded-xl">
                <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center bg-white/5">
                        <span class="material-symbols-outlined text-white text-4xl">work</span>
                    </div>
                <?php endif; ?>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-white mb-1"><?php echo htmlspecialchars($job['title']); ?></h1>
            <div class="flex items-center gap-1.5 text-gray-400 mb-6">
                <span class="material-symbols-outlined text-[18px] text-primary">verified</span>
                <span class="text-sm font-medium"><?php echo htmlspecialchars($job['company_name']); ?></span>
            </div>
            <!-- Chips Row -->
            <div class="flex flex-wrap justify-center gap-3 w-full">
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/5 border border-white/5 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-[16px] text-accent-green">location_on</span>
                    <span class="text-xs font-medium text-gray-200"><?php echo htmlspecialchars($job['location']); ?></span>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/5 border border-white/5 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-[16px] text-accent-green">work</span>
                    <span class="text-xs font-medium text-gray-200"><?php echo htmlspecialchars($job['job_type']); ?></span>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-white/5 border border-white/5 backdrop-blur-sm">
                    <span class="material-symbols-outlined text-[16px] text-accent-green">payments</span>
                    <span class="text-xs font-medium text-gray-200"><?php echo formatSalary($job['salary_range']); ?></span>
                </div>
            </div>
        </div>
        <!-- About Section -->
        <div class="flex flex-col gap-3">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <span class="w-1 h-5 rounded-full bg-primary block"></span>
                About the Role
            </h2>
            <div class="text-gray-300 text-sm leading-relaxed font-light">
                <?php echo nl2br(htmlspecialchars($job['description'])); ?>
            </div>
        </div>
        <!-- Map/Location Preview -->
        <div class="flex flex-col gap-3 mt-2">
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <span class="w-1 h-5 rounded-full bg-primary block"></span>
                Location
            </h2>
            <div class="glass-panel p-2 rounded-2xl">
                <div class="w-full h-32 rounded-xl bg-gray-800 relative overflow-hidden">
                    <img alt="Map view of Port Harcourt city showing main roads" class="w-full h-full object-cover opacity-60 hover:opacity-80 transition-opacity" data-location="Port Harcourt" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVRJRHUTehX9B68WkmrallC3SkgHKEMt0ocx3TnRJdbKRTM64rnlkgqZrOWDEYD3CsMKeZCHOQCTyOcujm8yNVLl3-K3YfmxaSZ5zQEOKzjdLki-C2xYcTNDEivUPIHiNV88qx-r3705GbWW6OeFGN-JfN6ziy0Z4DpvuAtbc7nkImKgjWSSI5SAhDJe5FtpNGNQmdYrYu-jvIYuybaZ_8joU_CHKYL0igcfJ-S9V1IpZybOwaiQHh9GKdDtV2EJ_AWeRNYycIkdmw"/>
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-12 h-12 rounded-full bg-primary/30 flex items-center justify-center animate-pulse">
                            <div class="w-4 h-4 rounded-full bg-primary shadow-[0_0_10px_#1111d4]"></div>
                        </div>
                    </div>
                </div>
                <div class="p-3">
                    <p class="text-xs text-gray-400">Old GRA, Port Harcourt, Rivers State</p>
                </div>
            </div>
        </div>
        
        <div class="mt-8">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="login.php" class="w-full h-14 rounded-xl bg-primary text-white font-bold text-lg tracking-wide shadow-neumorphic-btn active:scale-[0.98] active:shadow-none transition-all duration-200 flex items-center justify-center gap-3 relative overflow-hidden group">
                    <span>Login to Apply</span>
                    <span class="material-symbols-outlined text-[20px]">login</span>
                </a>
            <?php elseif ($_SESSION['user_role'] === 'employer'): ?>
                <div class="w-full h-14 rounded-xl bg-gray-700 text-gray-400 font-bold text-lg flex items-center justify-center gap-3 cursor-not-allowed">
                    <span>Employers cannot apply</span>
                </div>
            <?php else: ?>
                <form action="actions/application_code.php" method="POST" enctype="multipart/form-data" class="w-full">
                    <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Cover Letter</label>
                        <textarea name="cover_letter" rows="4" class="w-full bg-[#101022] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="Why are you a good fit?"></textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Resume (PDF)</label>
                        <input type="file" name="resume" accept=".pdf" required class="w-full text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    </div>
                    <button type="submit" name="apply" class="w-full h-14 rounded-xl bg-primary text-white font-bold text-lg tracking-wide shadow-neumorphic-btn active:scale-[0.98] active:shadow-none transition-all duration-200 flex items-center justify-center gap-3 relative overflow-hidden group">
                        <div class="absolute top-0 -left-[100%] w-[50%] h-full bg-gradient-to-r from-transparent via-white/20 to-transparent skew-x-[-20deg] group-hover:animate-[shimmer_1.5s_infinite]"></div>
                        <span>Apply Now</span>
                        <span class="material-symbols-outlined text-[20px]">send</span>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </main>
</div>

<style>
    @keyframes shimmer {
        0% { left: -100%; }
        100% { left: 200%; }
    }
</style>

<?php include 'includes/footer.php'; ?>