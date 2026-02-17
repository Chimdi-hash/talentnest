<?php include 'includes/header.php'; ?>

<div class="max-w-4xl mx-auto pb-20">
    <main class="flex-1 px-5 py-6 flex flex-col gap-8 relative z-10 pb-20">
        
        <?php if (isset($_GET['success'])): ?>
            <div class="bg-green-500/10 border border-green-500/50 text-green-500 p-3 rounded-lg text-sm text-center">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500/10 border border-red-500/50 text-red-500 p-3 rounded-lg text-sm text-center">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Segmented Control (Tabs) -->
        <div class="p-1 bg-[#151621] rounded-xl shadow-inset-dark flex relative">
            <button id="tab-faq" onclick="switchTab('faq')" class="flex-1 py-2.5 px-4 rounded-lg bg-primary text-white text-sm font-medium shadow-neon-blue transition-all relative z-10">
                FAQs
            </button>
            <button id="tab-contact" onclick="switchTab('contact')" class="flex-1 py-2.5 px-4 rounded-lg text-slate-400 hover:text-white text-sm font-medium transition-colors">
                Contact
            </button>
        </div>
        
        <!-- FAQ Section -->
        <div id="faq-section">
            <!-- Search Bar -->
            <div class="relative group mb-8">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-slate-500 group-focus-within:text-primary transition-colors">search</span>
                </div>
                <input class="block w-full pl-10 pr-3 py-3 rounded-xl bg-[#151621] border-none text-white placeholder-slate-500 shadow-inset-dark focus:ring-1 focus:ring-primary/50 focus:shadow-neon-blue transition-all sm:text-sm" placeholder="Search for help..." type="text"/>
            </div>

            <section class="flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-white text-xl font-bold tracking-tight">Common Questions</h2>
                    <span class="text-xs text-primary font-medium cursor-pointer">View All</span>
                </div>
                <div class="flex flex-col gap-3">
                    <!-- FAQ Item 1 -->
                    <details class="group glass-panel rounded-xl overflow-hidden transition-all duration-300 open:bg-white/5 open:border-primary/30">
                        <summary class="flex cursor-pointer items-center justify-between gap-4 p-4 select-none">
                            <span class="text-white text-sm font-medium leading-relaxed group-hover:text-primary-glow transition-colors">How do I post a job in Port Harcourt?</span>
                            <span class="material-symbols-outlined text-slate-400 transition-transform duration-300 group-open:rotate-180 group-open:text-primary">expand_more</span>
                        </summary>
                        <div class="px-4 pb-4 pt-0 text-slate-400 text-sm leading-relaxed border-t border-white/5 mt-2">
                            <p class="pt-3">Navigate to the 'Post' tab on the main dashboard. Fill in the job title, description, and select 'Port Harcourt' as the location. Once submitted, our team will review it within 24 hours.</p>
                        </div>
                    </details>
                    <!-- FAQ Item 2 -->
                    <details class="group glass-panel rounded-xl overflow-hidden transition-all duration-300 open:bg-white/5 open:border-primary/30">
                        <summary class="flex cursor-pointer items-center justify-between gap-4 p-4 select-none">
                            <span class="text-white text-sm font-medium leading-relaxed group-hover:text-primary-glow transition-colors">Can I edit my application after submitting?</span>
                            <span class="material-symbols-outlined text-slate-400 transition-transform duration-300 group-open:rotate-180 group-open:text-primary">expand_more</span>
                        </summary>
                        <div class="px-4 pb-4 pt-0 text-slate-400 text-sm leading-relaxed border-t border-white/5 mt-2">
                            <p class="pt-3">Currently, applications cannot be edited once submitted to ensure fairness. You can, however, withdraw an application and submit a new one if the deadline hasn't passed.</p>
                        </div>
                    </details>
                    <!-- FAQ Item 3 -->
                    <details class="group glass-panel rounded-xl overflow-hidden transition-all duration-300 open:bg-white/5 open:border-primary/30">
                        <summary class="flex cursor-pointer items-center justify-between gap-4 p-4 select-none">
                            <span class="text-white text-sm font-medium leading-relaxed group-hover:text-primary-glow transition-colors">How do I reset my account password?</span>
                            <span class="material-symbols-outlined text-slate-400 transition-transform duration-300 group-open:rotate-180 group-open:text-primary">expand_more</span>
                        </summary>
                        <div class="px-4 pb-4 pt-0 text-slate-400 text-sm leading-relaxed border-t border-white/5 mt-2">
                            <p class="pt-3">Go to Settings &gt; Security and tap on "Change Password". If you are logged out, use the "Forgot Password" link on the login screen to receive a recovery email.</p>
                        </div>
                    </details>
                </div>
            </section>
        </div>

        <!-- Divider -->
        <div class="h-px w-full bg-gradient-to-r from-transparent via-white/10 to-transparent my-2 hidden"></div>

        <!-- Contact Section -->
        <div id="contact-section" class="hidden">
            <section class="flex flex-col gap-5">
                <div class="space-y-1">
                    <h2 class="text-white text-xl font-bold tracking-tight">Get in Touch</h2>
                    <p class="text-slate-500 text-sm">Our support team is available 24/7.</p>
                </div>
                <!-- Direct Action Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <a class="glass-panel group p-4 rounded-xl flex flex-col items-center justify-center gap-2 hover:bg-white/10 transition-all border-l-2 border-l-transparent hover:border-l-accent" href="https://wa.me/2348000000000" target="_blank">
                        <div class="size-10 rounded-full bg-accent/10 flex items-center justify-center group-hover:bg-accent/20 transition-colors shadow-neon-green">
                            <span class="material-symbols-outlined text-accent" style="font-size: 20px;">chat</span>
                        </div>
                        <span class="text-white font-medium text-sm">WhatsApp</span>
                    </a>
                    <a class="glass-panel group p-4 rounded-xl flex flex-col items-center justify-center gap-2 hover:bg-white/10 transition-all border-l-2 border-l-transparent hover:border-l-primary" href="https://mail.google.com/mail/?view=cm&fs=1&to=unaezechimdi@gmail.com" target="_blank">
                        <div class="size-10 rounded-full bg-primary/20 flex items-center justify-center group-hover:bg-primary/30 transition-colors shadow-neon-blue">
                            <span class="material-symbols-outlined text-primary-glow" style="font-size: 20px;">mail</span>
                        </div>
                        <span class="text-white font-medium text-sm">Email</span>
                    </a>
                </div>
                <!-- Contact Form -->
                <div class="glass-panel rounded-2xl p-5 border-t border-t-white/10">
                    <h3 class="text-white text-sm font-semibold mb-4 uppercase tracking-wider text-opacity-80">Send a Message</h3>
                    <form action="actions/contact_code.php" method="POST" class="flex flex-col gap-4">
                        <div class="space-y-1.5">
                            <label class="text-xs text-slate-400 font-medium ml-1">Full Name</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-3 text-slate-500 text-[18px]">person</span>
                                <input name="name" required class="w-full pl-9 pr-3 py-2.5 rounded-lg bg-[#151621] border-none text-white text-sm shadow-inset-dark focus:ring-1 focus:ring-primary focus:shadow-neon-blue placeholder-slate-600 transition-all" placeholder="John Doe" type="text"/>
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs text-slate-400 font-medium ml-1">Email Address</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-3 text-slate-500 text-[18px]">alternate_email</span>
                                <input name="email" required class="w-full pl-9 pr-3 py-2.5 rounded-lg bg-[#151621] border-none text-white text-sm shadow-inset-dark focus:ring-1 focus:ring-primary focus:shadow-neon-blue placeholder-slate-600 transition-all" placeholder="john@example.com" type="email"/>
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs text-slate-400 font-medium ml-1">Message</label>
                            <textarea name="message" required class="w-full p-3 rounded-lg bg-[#151621] border-none text-white text-sm shadow-inset-dark focus:ring-1 focus:ring-primary focus:shadow-neon-blue placeholder-slate-600 transition-all resize-none" placeholder="Describe your issue..." rows="4"></textarea>
                        </div>
                        <button type="submit" class="mt-2 w-full py-3 px-4 bg-gradient-to-r from-primary to-[#3b3bf6] rounded-xl text-white font-semibold text-sm shadow-neon-blue hover:shadow-lg hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                            <span>Send Message</span>
                            <span class="material-symbols-outlined text-[18px]">send</span>
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>
</div>

<script>
function switchTab(tab) {
    const faqSection = document.getElementById('faq-section');
    const contactSection = document.getElementById('contact-section');
    const tabFaq = document.getElementById('tab-faq');
    const tabContact = document.getElementById('tab-contact');

    if (tab === 'faq') {
        faqSection.classList.remove('hidden');
        contactSection.classList.add('hidden');
        
        tabFaq.classList.add('bg-primary', 'text-white', 'shadow-neon-blue');
        tabFaq.classList.remove('text-slate-400');
        
        tabContact.classList.remove('bg-primary', 'text-white', 'shadow-neon-blue');
        tabContact.classList.add('text-slate-400');
    } else {
        faqSection.classList.add('hidden');
        contactSection.classList.remove('hidden');
        
        tabContact.classList.add('bg-primary', 'text-white', 'shadow-neon-blue');
        tabContact.classList.remove('text-slate-400');
        
        tabFaq.classList.remove('bg-primary', 'text-white', 'shadow-neon-blue');
        tabFaq.classList.add('text-slate-400');
    }
}
</script>
    </main>
</div>

<?php include 'includes/footer.php'; ?>