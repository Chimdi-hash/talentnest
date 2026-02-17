<?php 
include 'includes/header.php'; 
require_once 'includes/functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'seeker') {
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

$user = getUserById($_SESSION['user_id']);

// Fetch applications
$stmt = $pdo->prepare("SELECT applications.*, jobs.title, jobs.location, users.name as company_name, users.profile_image as company_logo 
                       FROM applications 
                       JOIN jobs ON applications.job_id = jobs.id 
                       JOIN users ON jobs.employer_id = users.id 
                       WHERE applications.seeker_id = :seeker_id 
                       ORDER BY applications.created_at DESC");
$stmt->execute(['seeker_id' => $_SESSION['user_id']]);
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="max-w-4xl mx-auto pb-20">
    <main class="relative z-10 flex flex-col gap-6 p-4 w-full">
        <!-- Profile Header Card (Glassmorphism) -->
        <section class="glass-panel rounded-xl p-6 flex flex-col gap-6 relative overflow-hidden group">
            <!-- Glow effect behind avatar -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-32 h-32 bg-primary/20 blur-[50px] rounded-full pointer-events-none"></div>
            <div class="flex flex-col items-center gap-4 relative z-10">
                <div class="relative">
                    <div class="w-28 h-28 rounded-full p-1 bg-gradient-to-tr from-primary to-transparent">
                        <div class="w-full h-full rounded-full bg-gray-800 bg-center bg-cover border-4 border-[#101022]" 
                             style="background-image: url('https://ui-avatars.com/api/?name=<?php echo urlencode($user['name']); ?>&background=random');">
                        </div>
                    </div>
                    <div class="absolute bottom-1 right-1 bg-accent-green border-4 border-[#101022] w-6 h-6 rounded-full"></div>
                </div>
                <div class="text-center">
                    <h1 class="text-2xl font-bold tracking-tight text-white"><?php echo htmlspecialchars($user['name']); ?></h1>
                    <p class="text-[#9d9db9] font-medium text-sm mt-1"><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            </div>
        </section>
        <!-- Stats Row -->
        <section class="grid grid-cols-3 gap-3">
            <div class="glass-panel rounded-xl p-3 flex flex-col items-center justify-center gap-1 text-center min-h-[100px]">
                <span class="material-symbols-outlined text-[#9d9db9] text-[20px] mb-1">visibility</span>
                <span class="text-xl font-bold text-white">0</span>
                <span class="text-[10px] text-[#9d9db9] font-medium uppercase tracking-wide">Views</span>
            </div>
            <div class="glass-panel rounded-xl p-3 flex flex-col items-center justify-center gap-1 text-center min-h-[100px] border-primary/30 bg-primary/5">
                <span class="material-symbols-outlined text-primary text-[20px] mb-1">work_history</span>
                <span class="text-xl font-bold text-white"><?php echo count($applications); ?></span>
                <span class="text-[10px] text-primary font-medium uppercase tracking-wide">Applied</span>
            </div>
            <div class="glass-panel rounded-xl p-3 flex flex-col items-center justify-center gap-1 text-center min-h-[100px]">
                <span class="material-symbols-outlined text-[#9d9db9] text-[20px] mb-1">bookmark</span>
                <span class="text-xl font-bold text-white">0</span>
                <span class="text-[10px] text-[#9d9db9] font-medium uppercase tracking-wide">Saved</span>
            </div>
        </section>
        <!-- Resume Upload (Neumorphic Style) -->
        <section class="rounded-xl shadow-neumorph-inset bg-[#101022] p-5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-[#15152d] flex items-center justify-center text-primary shadow-neumorph-flat">
                    <span class="material-symbols-outlined">cloud_upload</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-white">Resume Upload</span>
                    <span class="text-xs text-[#6b6b85] max-w-[160px]">Tap to upload or update your CV (PDF, Docx)</span>
                </div>
            </div>
            <button class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-white shadow-glow hover:scale-105 transition-transform active:scale-95">
                <span class="material-symbols-outlined text-[20px]">add</span>
            </button>
        </section>
        <!-- Content Tabs -->
        <div class="flex p-1 bg-[#0b0b17] rounded-lg shadow-inner">
            <button class="flex-1 py-2 text-xs font-medium rounded text-center transition-all glass-tab-active shadow-sm">
                Applications
            </button>
            <button class="flex-1 py-2 text-xs font-medium rounded text-center text-[#6b6b85] hover:text-white transition-all">
                Saved Jobs
            </button>
            <button class="flex-1 py-2 text-xs font-medium rounded text-center text-[#6b6b85] hover:text-white transition-all">
                Interviews
            </button>
        </div>
        <!-- Applications List -->
        <section class="flex flex-col gap-3 pb-8">
            <div class="flex justify-between items-center px-1">
                <h3 class="text-sm font-semibold text-white">Recent Activity</h3>
                <a class="text-xs text-primary font-medium" href="#">See All</a>
            </div>
            <!-- Job Card 1 -->
            <div class="glass-panel p-4 rounded-xl flex flex-col gap-3 group hover:border-primary/40 transition-colors cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center p-1 shrink-0">
                            <img alt="Shell Logo" class="w-full h-full object-contain" data-alt="Shell Company Logo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDDda7ZoBVt4rowQkMt283jr12H0jCTZdaKOLLahOqAMRgdzNd9CAPEnjiaM9CmBy1_MufL27bvSPrKLsB8Dmc3whUOTx4HPCiw3_mZMj6hKOjewb2LHwfB4Yx2DLi2tO1MmOt9Fwe-RCV7KI1H60h5Q0uo8rqM9E_kl9q6A_lKMVADbsuvxvjR8jRccJ4stRN53gosHI0-xaiYVGrQ5oLSY6wPJLiPUGSXyZjkjFN_inkB9ZCniLWrXTLho9ldTw1jMdUHVsk954F0"/>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white group-hover:text-primary transition-colors">Frontend Developer</h4>
                            <p class="text-xs text-[#9d9db9]">Shell Nigeria • Port Harcourt</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded bg-accent-green/10 border border-accent-green/20 text-[10px] font-bold text-accent-green uppercase tracking-wide">
                        Active
                    </span>
                </div>
                <div class="flex items-center justify-between mt-1 pt-3 border-t border-white/5">
                    <div class="flex items-center gap-1 text-[10px] text-[#6b6b85]">
                        <span class="material-symbols-outlined text-[12px]">schedule</span>
                        <span>Applied 2 days ago</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-1.5 h-1.5 rounded-full bg-accent-green animate-pulse"></div>
                        <span class="text-[10px] font-medium text-white">Application Sent</span>
                    </div>
                </div>
            </div>
            <!-- Job Card 2 -->
            <div class="glass-panel p-4 rounded-xl flex flex-col gap-3 group hover:border-primary/40 transition-colors cursor-pointer">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center p-1 shrink-0">
                            <!-- Placeholder Logo -->
                            <div class="w-full h-full bg-gradient-to-br from-purple-600 to-blue-600 rounded flex items-center justify-center text-white font-bold text-xs" data-alt="Generic Tech Company Logo Gradient">TN</div>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white group-hover:text-primary transition-colors">UX/UI Designer</h4>
                            <p class="text-xs text-[#9d9db9]">TechNest • Remote</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded bg-primary/10 border border-primary/20 text-[10px] font-bold text-primary uppercase tracking-wide">
                        Interview
                    </span>
                </div>
                <div class="flex items-center justify-between mt-1 pt-3 border-t border-white/5">
                    <div class="flex items-center gap-1 text-[10px] text-[#6b6b85]">
                        <span class="material-symbols-outlined text-[12px]">schedule</span>
                        <span>Updated 5h ago</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <div class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></div>
                        <span class="text-[10px] font-medium text-white">Scheduled</span>
                    </div>
                </div>
            </div>
            <!-- Job Card 3 -->
            <div class="glass-panel p-4 rounded-xl flex flex-col gap-3 group hover:border-primary/40 transition-colors cursor-pointer opacity-70">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center p-1 shrink-0">
                            <div class="w-full h-full bg-black rounded flex items-center justify-center text-white font-bold text-xs" data-alt="Black box logo">DS</div>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-white">Data Scientist</h4>
                            <p class="text-xs text-[#9d9db9]">Dangote • Lagos</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 rounded bg-gray-700/30 border border-gray-600/30 text-[10px] font-bold text-gray-400 uppercase tracking-wide">
                        Saved
                    </span>
                </div>
                <div class="flex items-center justify-between mt-1 pt-3 border-t border-white/5">
                    <div class="flex items-center gap-1 text-[10px] text-[#6b6b85]">
                        <span class="material-symbols-outlined text-[12px]">bookmark_added</span>
                        <span>Saved 1w ago</span>
                    </div>
                    <button class="text-[10px] font-bold text-primary hover:text-white transition-colors">Apply Now</button>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Floating Action Button (Optional Overlay) -->
    <div class="fixed bottom-20 right-4 z-40">
        <button class="w-14 h-14 rounded-full bg-gradient-to-tr from-primary to-[#3b3bff] text-white shadow-glow flex items-center justify-center hover:scale-105 transition-transform active:scale-95">
            <span class="material-symbols-outlined">edit_document</span>
        </button>
    </div>
</div>

<?php include 'includes/footer.php'; ?>