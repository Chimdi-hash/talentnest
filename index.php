<?php 
include 'includes/header.php'; 
require_once 'includes/functions.php';
$featured_jobs = getAllJobs(5);
?>

<section class="relative px-5 pt-12 pb-16 md:pt-20 md:pb-24 overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-primary/10 to-transparent pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-background-dark to-transparent pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
        <!-- Left Column: Text Content -->
        <div class="flex flex-col gap-8">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 w-fit backdrop-blur-sm">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-green opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-accent-green"></span>
                </span>
                <span class="text-xs font-medium text-gray-300 tracking-wide uppercase">#1 Job Platform in Port Harcourt</span>
            </div>
            
            <h2 class="text-5xl md:text-7xl font-black leading-[1.1] tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white via-gray-100 to-gray-500 drop-shadow-lg">
                Future of Work <br>
                <span class="text-stroke-white text-transparent" style="-webkit-text-stroke: 1px rgba(255,255,255,0.3);">Starts Here</span>
            </h2>
            
            <p class="text-lg md:text-xl text-gray-400 font-light max-w-xl leading-relaxed">
                Connect with top-tier employers and discover opportunities that match your ambition in the Garden City and beyond.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 mt-2">
                <button onclick="window.location.href='jobs.php'" class="h-14 px-8 rounded-full bg-white text-background-dark font-bold text-lg hover:bg-gray-200 transition-all duration-300 shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] flex items-center justify-center gap-2 group">
                    Find a Job
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
                <button onclick="window.location.href='employer_dashboard.php'" class="h-14 px-8 rounded-full bg-white/5 text-white font-bold text-lg border border-white/10 hover:bg-white/10 transition-all duration-300 backdrop-blur-sm flex items-center justify-center gap-2">
                    Post a Job
                </button>
            </div>

            <!-- Stats HUD -->
            <div class="grid grid-cols-3 gap-4 mt-8 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md">
                <div class="flex flex-col items-center border-r border-white/10">
                    <span class="text-2xl font-bold text-white">500+</span>
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest">Active Jobs</span>
                </div>
                <div class="flex flex-col items-center border-r border-white/10">
                    <span class="text-2xl font-bold text-accent-green">120+</span>
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest">Companies</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="text-2xl font-bold text-blue-400">300+</span>
                    <span class="text-[10px] text-gray-400 uppercase tracking-widest">Hired</span>
                </div>
            </div>
        </div>

        <!-- Right Column: 3D Image -->
        <div class="relative hidden lg:block h-[600px] w-full perspective-1000">
            <!-- Floating Elements -->
            <div class="absolute top-10 right-10 w-20 h-20 bg-blue-500/20 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute bottom-20 left-10 w-32 h-32 bg-primary/20 rounded-full blur-3xl animate-pulse delay-700"></div>
            
            <!-- Main Image Container -->
            <div class="relative w-full h-full flex items-center justify-center animate-float">
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/20 to-transparent rounded-full blur-[100px] transform scale-75"></div>
                <img src="https://cdn3d.iconscout.com/3d/premium/thumb/man-wearing-vr-glasses-4035931-3342608.png" 
                     alt="Future of Work VR Avatar" 
                     class="relative z-10 w-[80%] h-auto object-contain drop-shadow-[0_20px_50px_rgba(0,0,0,0.5)] hover:scale-105 transition-transform duration-500"
                     style="filter: drop-shadow(0 0 20px rgba(17, 17, 212, 0.3));">
                
                <!-- Floating Cards -->
                <div class="absolute top-[20%] right-[10%] p-3 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 shadow-xl animate-float-delayed">
                    <div class="flex items-center gap-3">
                        <div class="size-8 rounded-full bg-green-500/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-400 text-sm">check</span>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">Status</div>
                            <div class="text-sm font-bold text-white">Hired</div>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-[25%] left-[5%] p-3 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 shadow-xl animate-float-reverse">
                    <div class="flex items-center gap-3">
                        <div class="size-8 rounded-full bg-blue-500/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-400 text-sm">mail</span>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400">New Offer</div>
                            <div class="text-sm font-bold text-white">$120k/yr</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        @keyframes float-reverse {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(15px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 5s ease-in-out infinite 1s; }
        .animate-float-reverse { animation: float-reverse 7s ease-in-out infinite 0.5s; }
        .perspective-1000 { perspective: 1000px; }
    </style>
</section>

<section class="mt-2">
    <div class="flex justify-between items-end px-5 mb-4">
        <h3 class="text-xl font-bold text-white tracking-tight">Featured Jobs</h3>
        <a class="text-sm text-primary font-medium hover:text-blue-400 transition-colors" href="jobs.php">View All</a>
    </div>
    <div class="flex overflow-x-auto gap-4 px-5 pb-8 no-scrollbar snap-x snap-mandatory">
        <?php foreach ($featured_jobs as $job): ?>
        <div class="snap-center shrink-0 w-[280px] glass-card-strong rounded-2xl p-4 flex flex-col gap-4 group">
            <div class="flex justify-between items-start">
                <div class="size-10 rounded-lg bg-white/10 flex items-center justify-center backdrop-blur-sm overflow-hidden">
                    <?php if ($job['company_logo']): ?>
                        <img src="<?php echo htmlspecialchars($job['company_logo']); ?>" alt="Logo" class="w-full h-full object-cover">
                    <?php else: ?>
                        <span class="material-symbols-outlined text-white">work</span>
                    <?php endif; ?>
                </div>
                <span class="px-2 py-1 rounded-md bg-accent-green/20 border border-accent-green/30 text-accent-green text-[10px] font-bold uppercase tracking-wider">New</span>
            </div>
            <div>
                <h4 class="text-lg font-bold text-white mb-1 group-hover:text-primary transition-colors line-clamp-1"><?php echo htmlspecialchars($job['title']); ?></h4>
                <p class="text-sm text-gray-400"><?php echo htmlspecialchars($job['company_name']); ?></p>
            </div>
            <div class="flex items-center gap-2 text-xs text-gray-500 font-medium">
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">location_on</span> <?php echo htmlspecialchars($job['location']); ?></span>
                <span class="size-1 rounded-full bg-gray-600"></span>
                <span class="flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span> <?php echo htmlspecialchars($job['job_type']); ?></span>
            </div>
            <div class="pt-2 border-t border-white/5 mt-auto">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-white"><?php echo formatSalary($job['salary_range']); ?><span class="text-gray-500 font-normal text-xs">/mo</span></span>
                    <button onclick="window.location.href='job_details.php?id=<?php echo $job['id']; ?>'" class="size-8 rounded-full bg-white text-background-dark flex items-center justify-center hover:bg-gray-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if (empty($featured_jobs)): ?>
            <div class="w-full text-center text-gray-400 py-8">No jobs found.</div>
        <?php endif; ?>
    </div>
</section>

<section class="px-5 pb-8">
    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-4">Trusted By</h3>
    <div class="flex justify-between items-center opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
        <div class="h-8 w-20 bg-white/20 rounded mask-image" style="-webkit-mask-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxMDAgMzAiPjxyZWN0IHdpZHRoPSIxMDAiIGhlaWdodD0iMzAiIGZpbGw9ImJsYWNrIi8+PC9zdmc+');"></div>
        <div class="text-xl font-black text-white/40 font-display">bolt</div>
        <div class="text-xl font-bold text-white/40 font-display italic">stripe</div>
        <div class="text-xl font-bold text-white/40 font-display">paystack</div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>