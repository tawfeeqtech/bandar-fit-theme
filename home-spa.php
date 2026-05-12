<?php
/**
 * BANDAR FIT - Single Page Application (Clean Version)
 * @package BandarFit
 */

// Disable WordPress header and footer for SPA
define('NO_HEADER_FOOTER', true);
?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BANDAR FIT - هندسة أداء المحترفين</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#C5A880', 
                        dark: '#0F0F0F',  
                        surface: '#1A1A1A', 
                    },
                    fontFamily: { sans: ['Cairo', 'sans-serif'] },
                }
            }
        }
    </script>
    
    <style>
        body { background-color: #0F0F0F; color: #E2E8F0; font-family: 'Cairo', sans-serif; overflow-x: hidden; }
        .gold-glow { text-shadow: 0 0 20px rgba(197, 168, 128, 0.4); }
        .gold-gradient { background: linear-gradient(135deg, #C5A880 0%, #A68B63 100%); }
        .hero-mask { background: linear-gradient(to bottom, transparent 0%, #0F0F0F 95%); }
        
        .eval-compact-card {
            background: #1A1A1A;
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2.5rem 1.5rem;
            border-radius: 2rem;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
        }
        .eval-compact-card:hover {
            border-color: #C5A880;
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.5);
        }

        .album-container {
            overflow: hidden;
            border-radius: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
            height: 250px;
            position: relative;
        }
        .album-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(100%) brightness(0.7);
            transition: 0.6s all ease;
            animation: kenburns 15s infinite alternate ease-in-out;
        }
        .album-container:hover .album-img {
            filter: grayscale(0%) brightness(1);
            animation-play-state: paused;
            transform: scale(1.1);
        }
        @keyframes kenburns {
            0% { transform: scale(1); }
            100% { transform: scale(1.2); }
        }

        .service-card { background: #1A1A1A; transition: all 0.5s ease; border: 1px solid rgba(255,255,255,0.05); }
        .service-card:hover { transform: translateY(-10px); border-color: #C5A880; box-shadow: 0 20px 40px rgba(0,0,0,0.6); }
        
        .view-content { display: none; opacity: 0; transform: translateY(40px); transition: all 0.6s ease-out; }
        .view-content.active { display: block; opacity: 1; transform: translateY(0); }
        
        .price-card { background: #1A1A1A; border: 1px solid rgba(255,255,255,0.05); transition: 0.4s; display: flex; flex-direction: column; align-items: center; }
        .featured-elite { 
            border: 2px solid #C5A880; 
            transform: scale(1.1); 
            z-index: 20; 
            box-shadow: 0 25px 60px rgba(0,0,0,0.8);
            background: #1e1e1e;
        }

        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }

        .step-box { background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); transition: 0.4s; }
        .step-box:hover { border-color: #C5A880; background: rgba(197, 168, 128, 0.05); }

        .video-overlay { background: linear-gradient(to top, rgba(15,15,15,0.9) 0%, transparent 100%); }
    </style>
</head>
<body class="antialiased text-right">

    <!-- شريط البراند العلوي -->
    <div class="bg-surface/80 backdrop-blur-md border-b border-white/5 py-2 px-6 fixed top-0 w-full z-[110]">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <span class="text-[10px] font-bold text-brand uppercase tracking-widest italic text-center">Bandar Performance Architecture</span>
            <div class="flex gap-4 items-center text-center">
                <button id="musicToggle" class="text-white/40 hover:text-brand transition-colors">
                    <i data-lucide="music-2" class="w-4 h-4"></i>
                </button>
                <a href="#" class="text-white/40 hover:text-brand transition-colors"><i data-lucide="instagram" class="w-4 h-4"></i></a>
                <a href="#" class="text-white/40 hover:text-brand transition-colors"><i data-lucide="snapchat" class="w-4 h-4"></i></a>
            </div>
        </div>
    </div>

    <!-- زر واتساب العائم -->
    <a href="<?php echo esc_url(bandar_get_whatsapp_url()); ?>" target="_blank" class="whatsapp-float" title="تواصل معنا عبر واتساب">
        <svg class="w-8 h-8 fill-current" viewBox="0 0 448 512">
            <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.7 17.8 69.4 27.2 106.2 27.2 122.4 0 222-99.6 222-222 0-59.3-23-115.1-65-157.1zM223.9 446.3c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 365.9l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.5-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 54 81.2 54 130.4 0 101.7-82.8 184.5-184.5 184.5zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-5.5-2.8-23.2-8.5-44.2-27.1-16.4-14.6-27.4-32.7-30.6-38.2-3.2-5.5-.3-8.5 2.5-11.2 2.5-2.6 5.5-6.5 8.3-9.7 2.8-3.2 3.7-5.5 5.6-9.2 1.9-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 13.2 5.8 23.5 9.2 31.5 11.8 13.3 4.2 25.4 3.6 35 2.2 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
        </svg>
    </a>

    <!-- الهيدر والناف بار -->
    <header class="fixed top-8 w-full z-[100] transition-all duration-300" id="mainHeader">
        <div class="max-w-7xl mx-auto px-6 h-24 flex justify-between items-center text-center">
            <div class="flex items-center gap-3 text-center">
                <div class="w-10 h-10 bg-brand rounded-lg flex items-center justify-center shadow-lg shadow-brand/20">
                    <i data-lucide="shield" class="text-dark w-6 h-6"></i>
                </div>
                <span class="text-2xl font-black italic tracking-tighter uppercase text-brand gold-glow">BANDAR FIT</span>
            </div>
            
            <div id="backNav" class="hidden">
                <button onclick="showHome()" class="bg-white/5 backdrop-blur-md border border-white/10 px-8 py-3 rounded-full text-sm font-bold flex items-center gap-3 hover:bg-brand hover:text-dark transition-all">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i> الرئيسية
                </button>
            </div>
        </div>
    </header>

    <main id="appContainer">
        
        <!-- الواجهة الرئيسية -->
        <section id="homeView" class="min-h-screen relative flex items-center justify-center text-center">
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2000" class="w-full h-full object-cover opacity-20" alt="Football Hero">
                <div class="absolute inset-0 hero-mask"></div>
            </div>

            <div class="relative z-10 px-6 text-center max-w-4xl mx-auto">
                <span class="text-brand font-black text-[10px] uppercase tracking-[0.6em] mb-4 block italic text-center">Football Performance Architecture</span>
                <h1 class="text-4xl md:text-6xl font-black italic mb-6 leading-[1.1] tracking-tighter uppercase text-center">إعدادك بدنياً مع<br><span class="text-brand gold-glow">كوتش بندر</span></h1>
                <p class="text-white/40 text-base md:text-lg mb-12 max-w-xl mx-auto leading-relaxed italic text-center text-center text-center">"المباراة تُكسب في صالة التمارين قبل أن تبدأ في العشب"</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">
                    <div onclick="showView('ptView')" class="service-card p-10 rounded-[2.5rem] cursor-pointer group flex flex-col items-center text-center">
                        <i data-lucide="medal" class="text-brand w-10 h-10 mb-6 group-hover:scale-110 transition-all text-center"></i>
                        <h3 class="text-2xl font-black italic mb-2 uppercase text-center text-center">التدريب الحضوري</h3>
                        <p class="text-white/40 text-xs mb-6 uppercase text-center text-center">باقات مخصصة للنخبة</p>
                        <span class="text-brand text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 italic text-center">دخول البرنامج <i data-lucide="arrow-left" class="w-3 h-3 text-center"></i></span>
                    </div>
                    <div onclick="showView('evalView')" class="service-card p-10 rounded-[2.5rem] cursor-pointer group flex flex-col items-center">
                        <i data-lucide="clipboard-check" class="text-white w-10 h-10 mb-6 group-hover:scale-110 transition-all text-center"></i>
                        <h3 class="text-2xl font-black italic mb-2 uppercase text-center text-center">تقييمات الأداء</h3>
                        <p class="text-white/40 text-xs mb-6 uppercase text-center text-center text-center">تحليل علمي متطور</p>
                        <span class="text-brand text-[10px] font-black uppercase tracking-widest flex items-center justify-center gap-2 italic text-center">ابدأ الاختبار <i data-lucide="arrow-left" class="w-3 h-3"></i></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- قسم التدريب الحضوري -->
        <section id="ptView" class="view-content pt-40 pb-20 px-6 max-w-7xl mx-auto text-center">
            <div class="text-center mb-20 text-center">
                <span class="text-brand font-black text-xs uppercase tracking-[0.4em] mb-4 block italic text-center text-center">Professional Methodology</span>
                <h2 class="text-4xl md:text-5xl font-black italic mb-6 uppercase tracking-tighter text-white leading-tight text-center">هندسة الأداء البدني</h2>
                <p class="text-white/40 max-w-2xl mx-auto italic font-bold text-base text-center">5 خطوات علمية لنقل مستواك من الهاوي إلى المحترف تحت إشراف كوتش بندر.</p>
            </div>

            <!-- خطوات العمل (خطوات البداية) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-24 text-center">
                <div class="step-box p-6 rounded-3xl text-center">
                    <i data-lucide="microscope" class="text-brand w-7 h-7 mb-4 mx-auto text-center"></i>
                    <h4 class="text-sm font-black italic mb-2 uppercase">01. التحليل الأولي</h4>
                    <p class="text-white/40 text-[10px] italic">تحديد الأهداف الرياضية بناءً على مركزك.</p>
                </div>
                <div class="step-box p-6 rounded-3xl text-center text-center">
                    <i data-lucide="dumbbell" class="text-brand w-7 h-7 mb-4 mx-auto text-center"></i>
                    <h4 class="text-sm font-black italic mb-2 uppercase text-center">02. التدريب الميداني</h4>
                    <p class="text-white/40 text-[10px] italic">جلسات ميدانية تحاكي المباراة.</p>
                </div>
                <div class="step-box p-6 rounded-3xl text-center">
                    <i data-lucide="activity" class="text-brand w-7 h-7 mb-4 mx-auto text-center"></i>
                    <h4 class="text-sm font-black italic mb-2 uppercase text-brand text-center text-center">03. تحليل الأحمال</h4>
                    <p class="text-white/40 text-[10px] italic text-center text-center">موازنة شدة التمرين مع مستوى التعب.</p>
                </div>
                <div class="step-box p-6 rounded-3xl text-center text-center text-center">
                    <i data-lucide="utensils" class="text-brand w-7 h-7 mb-4 mx-auto text-center text-center"></i>
                    <h4 class="text-sm font-black italic mb-2 uppercase text-brand text-center text-center">04. جدول غذائي</h4>
                    <p class="text-white/40 text-[10px] italic text-center">خطة تغذية مخصصة لطاقة كافٍ.</p>
                </div>
                <div class="step-box p-6 rounded-3xl text-center text-center text-center">
                    <i data-lucide="heart-pulse" class="text-brand w-7 h-7 mb-4 mx-auto text-center text-center text-center"></i>
                    <h4 class="text-sm font-black italic mb-2 uppercase text-center text-center text-center">05. الوقاية والاستشفاء</h4>
                    <p class="text-white/40 text-[10px] italic text-center text-center text-center text-center">بروتوكول وقائي وتقوية المفاصل.</p>
                </div>
            </div>

            <!-- قسم مقاطع الرياضيين (ديناميكي) -->
            <div class="mb-32 text-center text-center">
                <h3 class="text-2xl font-black italic text-brand uppercase mb-10 text-center text-center">أداء رياضيينا النخبة</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center text-center">
                    <?php
                    // جلب الرياضيين من قاعدة البيانات
                    $athletes = get_posts([
                        'post_type' => 'athlete',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ]);
                    
                    if ($athletes) :
                        foreach ($athletes as $athlete) :
                            $athlete_image = get_the_post_thumbnail_url($athlete->ID, 'large');
                            if (!$athlete_image) {
                                $athlete_image = 'https://images.unsplash.com/photo-1544033527-b192daee1f5b?q=80&w=600';
                            }
                    ?>
                    <div class="rounded-[2rem] overflow-hidden relative group aspect-video border border-white/5 text-center">
                        <img src="<?php echo esc_url($athlete_image); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700 brightness-75" alt="<?php echo esc_attr($athlete->post_title); ?>">
                        <div class="absolute inset-0 video-overlay flex items-center justify-center text-center">
                            <div class="w-12 h-12 bg-brand/90 rounded-full flex items-center justify-center shadow-lg text-center text-center">
                                <i data-lucide="play" class="text-dark w-5 h-5 fill-dark ml-1 text-center text-center"></i>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-4 text-right">
                            <p class="text-[10px] font-black uppercase text-brand italic"><?php echo esc_html($athlete->post_title); ?></p>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <div class="col-span-3 text-center text-white/40">
                        <p>لا يوجد رياضيون حالياً</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- كواليس صناعة الأبطال -->
            <div class="mb-32 text-center text-center text-center">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center text-center">
                    <div class="lg:col-span-5 text-center">
                        <div class="rounded-[2.5rem] overflow-hidden relative group shadow-2xl aspect-video border border-white/5 text-center">
                            <img src="https://images.unsplash.com/photo-1543326727-cf6c39e8f84c?q=80&w=800" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700 brightness-50" alt="Field Training">
                            <div class="absolute inset-0 flex items-center justify-center cursor-pointer group-hover:scale-110 transition-all text-center">
                                <div class="w-16 h-16 bg-brand rounded-full flex items-center justify-center shadow-lg text-center text-center">
                                    <i data-lucide="play" class="text-dark w-6 h-6 fill-dark ml-1 text-center"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7 pr-4 text-center lg:text-right">
                        <h3 class="text-3xl font-black italic uppercase tracking-tighter mb-4 text-brand text-center text-center text-center">كواليس صناعة الأبطال</h3>
                        <p class="text-white/60 leading-relaxed mb-6 italic text-base text-center">
                            في هذه الجلسات الميدانية، ننتقل من مجرد التمارين العادية إلى **هندسة الحركة الواقعية**. نقوم بمحاكاة سيناريوهات المباراة الحقيقية لتطوير سرعتك الانفجارية، رشاقتك التكتيكية، وقوة التحمل تحت الضغط.
                        </p>
                        <div class="flex flex-col gap-4 text-center">
                            <div class="flex items-center gap-3 justify-center lg:justify-start text-center">
                                <i data-lucide="target" class="text-brand w-5 h-5 shrink-0 text-center"></i>
                                <span class="text-xs font-bold uppercase italic text-white/80 text-center">تطوير التوافق العضلي العصبي لرد فعل أسرع.</span>
                            </div>
                            <div class="flex items-center gap-3 justify-center lg:justify-start text-center">
                                <i data-lucide="zap" class="text-brand w-5 h-5 shrink-0 text-center"></i>
                                <span class="text-xs font-bold uppercase italic text-white/80 text-center">استخدام أدوات قياس اللحظة لزيادة السرعة القصوى.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الباقات والأسعار (ديناميكية) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center mb-24 text-center">
                <?php
                $training_packages = new WP_Query([
                    'post_type' => 'package',
                    'posts_per_page' => 3,
                    'meta_query' => [
                        'relation' => 'OR',
                        [
                            'key' => '_package_style',
                            'value' => 'standard',
                        ],
                        [
                            'key' => '_package_style',
                            'compare' => 'NOT EXISTS',
                        ]
                    ],
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ]);

                if ($training_packages->have_posts()) :
                    while ($training_packages->have_posts()) : $training_packages->the_post();
                        $pid = get_the_ID();
                        $sub = get_post_meta($pid, '_package_subtitle', true);
                        $pr = get_post_meta($pid, '_package_price', true);
                        $cur = get_post_meta($pid, '_package_currency', true) ?: 'ريال';
                        $btn = get_post_meta($pid, '_package_button_text', true) ?: 'اطلب الباقة';
                        $feat = get_post_meta($pid, '_package_is_featured', true) === '1';
                        $features_raw = get_post_meta($pid, '_package_features', true);
                        $features = explode("\n", str_replace("\r", "", $features_raw));
                ?>
                <div class="price-card <?php echo $feat ? 'featured-elite p-12 rounded-[3rem] relative' : 'p-8 rounded-3xl opacity-80 scale-95'; ?> text-center">
                    <?php if ($feat) : ?>
                        <div class="bg-brand text-dark text-[10px] font-black py-1.5 px-6 rounded-full absolute -top-4 left-1/2 -translate-x-1/2 uppercase italic shadow-xl text-center">الأكثر طلباً</div>
                    <?php endif; ?>
                    
                    <h4 class="<?php echo $feat ? 'text-2xl font-black italic mb-3 uppercase text-brand' : 'text-lg font-black italic mb-3 uppercase'; ?> text-center"><?php the_title(); ?></h4>
                    <p class="<?php echo $feat ? 'text-[11px] text-white/50 mb-4 font-bold uppercase italic' : 'text-[10px] text-white/30 mb-4 font-bold uppercase italic'; ?> text-center"><?php echo esc_html($sub); ?></p>
                    
                    <div class="<?php echo $feat ? 'mb-10' : 'mb-8'; ?> text-center">
                        <span class="<?php echo $feat ? 'text-6xl font-black italic text-brand gold-glow' : 'text-4xl font-black italic text-brand'; ?> text-center"><?php echo esc_html($pr); ?></span>
                        <span class="<?php echo $feat ? 'text-sm font-bold opacity-40 uppercase' : 'text-[10px] font-bold opacity-40 uppercase'; ?>"><?php echo esc_html($cur); ?></span>
                    </div>
                    
                    <ul class="<?php echo $feat ? 'space-y-5 mb-10 text-[12px] font-bold opacity-100' : 'space-y-4 mb-8 text-[11px] font-bold opacity-60'; ?> flex-grow w-full text-center">
                        <?php foreach ($features as $f) : if (trim($f)) : ?>
                        <li class="flex items-center justify-center gap-3 text-center">
                            <i data-lucide="check" class="text-brand <?php echo $feat ? 'w-5 h-5' : 'w-3 h-3'; ?> text-center"></i> 
                            <?php echo esc_html(trim($f)); ?>
                        </li>
                        <?php endif; endforeach; ?>
                    </ul>
                    
                    <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="block w-full <?php echo $feat ? 'py-5 gold-gradient text-dark rounded-2xl font-black text-lg italic hover:scale-105 transition-all shadow-xl' : 'py-4 border border-brand/20 text-brand rounded-xl font-black italic hover:bg-brand hover:text-dark transition-all'; ?> text-center">
                        <?php echo esc_html($btn); ?>
                    </a>
                </div>
                <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                <!-- باقة افتراضية -->
                <div class="price-card p-8 rounded-3xl opacity-80 scale-95 text-center text-center">
                    <h4 class="text-lg font-black italic mb-3 uppercase text-center text-center text-center">باقة الانطلاق</h4>
                    <p class="text-[10px] text-white/30 mb-4 font-bold uppercase italic text-center">06 حصص تدريبية</p>
                    <div class="mb-8">
                        <span class="text-4xl font-black italic text-brand text-center">1,200</span>
                        <span class="text-[10px] font-bold opacity-40 uppercase">ريال</span>
                    </div>
                    <ul class="space-y-4 mb-8 text-[11px] font-bold opacity-60 flex-grow text-center text-center text-center">
                        <li class="flex items-center justify-center gap-2"><i data-lucide="check" class="text-brand w-3 h-3 text-center text-center text-center text-center text-center"></i> حصص تدريبية ميدانية مكثفة</li>
                    </ul>
                    <button class="w-full py-4 border border-brand/20 text-brand rounded-xl font-black italic hover:bg-brand hover:text-dark transition-all">اطلب الباقة</button>
                </div>
                <?php endif; ?>
            </div>
            </div>
        </section>

        <!-- قسم التقييمات -->
        <section id="evalView" class="view-content pt-32 pb-20 px-6 max-w-7xl mx-auto text-center text-center text-center">
            <h2 class="text-4xl font-black italic mb-16 uppercase text-center text-center text-center text-center text-center">تقييمات الأداء الرياضي</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-24 text-center">
                <?php
                $eval_services = get_posts([
                    'post_type' => 'evaluation_service',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'ASC'
                ]);

                if ($eval_services) :
                    foreach ($eval_services as $service) :
                        $service_icon = get_post_meta($service->ID, '_service_icon', true) ?: 'activity';
                ?>
                <div class="eval-compact-card text-center">
                    <div class="w-14 h-14 bg-brand/10 rounded-2xl flex items-center justify-center border border-brand/20 mb-6 mx-auto"><i data-lucide="<?php echo esc_attr($service_icon); ?>" class="text-brand w-7 h-7"></i></div>
                    <h4 class="text-xl font-black italic mb-3 uppercase"><?php echo esc_html($service->post_title); ?></h4>
                    <div class="text-white/50 text-xs leading-relaxed italic"><?php echo apply_filters('the_content', $service->post_content); ?></div>
                </div>
                <?php
                    endforeach;
                else:
                ?>
                <div class="eval-compact-card text-center text-center text-center text-center">
                    <div class="w-14 h-14 bg-brand/10 rounded-2xl flex items-center justify-center border border-brand/20 mb-6 text-center text-center text-center text-center text-center"><i data-lucide="lungs" class="text-brand w-7 h-7"></i></div>
                    <h4 class="text-xl font-black italic mb-3 uppercase text-center text-center">VO2 Max (التحمل)</h4>
                    <p class="text-white/50 text-xs leading-relaxed italic text-center">قياس كفاءة القلب والرئتين للحفاظ على شدة اللعب طوال المباراة.</p>
                </div>
                <div class="eval-compact-card text-center text-center text-center text-center">
                    <div class="w-14 h-14 bg-brand/10 rounded-2xl flex items-center justify-center border border-brand/20 mb-6 text-center text-center text-center text-center"><i data-lucide="timer" class="text-brand w-7 h-7"></i></div>
                    <h4 class="text-xl font-black italic mb-3 uppercase text-center text-center">التسارع والسرعة</h4>
                    <p class="text-white/50 text-xs leading-relaxed italic text-center">تحليل بروفايل السرعة والقوة الانفجارية في الانطلاقة الأولى.</p>
                </div>
                <div class="eval-compact-card text-center text-center text-center">
                    <div class="w-14 h-14 bg-brand/10 rounded-2xl flex items-center justify-center border border-brand/20 mb-6 text-center text-center text-center text-center text-center"><i data-lucide="move" class="text-brand w-7 h-7"></i></div>
                    <h4 class="text-xl font-black italic mb-3 uppercase text-center text-center">الرشاقة وتغيير الاتجاه</h4>
                    <p class="text-white/50 text-xs leading-relaxed italic text-center">قياس قدرتك على المناورة والتحكم في مركز ثقل الجسم.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- ألبوم المختبر الحي -->
            <div class="mb-16 text-center">
                <h3 class="text-2xl font-black italic text-brand uppercase mb-10 text-center">ألبوم مختبر الأداء الحي</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center">
                    <?php
                    $lab_photos = get_posts([
                        'post_type' => 'lab_album',
                        'posts_per_page' => 6,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ]);

                    if ($lab_photos) :
                        foreach ($lab_photos as $photo) :
                            $photo_url = get_the_post_thumbnail_url($photo->ID, 'large');
                    ?>
                    <div class="album-container"><img src="<?php echo esc_url($photo_url); ?>" class="album-img" alt="<?php echo esc_attr($photo->post_title); ?>"></div>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <div class="album-container"><img src="https://images.unsplash.com/photo-1517649763962-0c623066013b?q=80&w=600" class="album-img" alt="Test 1"></div>
                    <div class="album-container"><img src="https://images.unsplash.com/photo-1461896836934-ffe607ba8211?q=80&w=600" class="album-img" alt="Test 2"></div>
                    <div class="album-container"><img src="https://images.unsplash.com/photo-1599058917232-d750c1859d7c?q=80&w=600" class="album-img" alt="Test 3"></div>
                    <div class="album-container"><img src="https://images.unsplash.com/photo-1526676037777-05a232554f7a?q=80&w=600" class="album-img" alt="Test 4"></div>
                    <div class="album-container"><img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=600" class="album-img" alt="Test 5"></div>
                    <div class="album-container"><img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=600" class="album-img" alt="Test 6"></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- قسم اختبارات رياضيين (ديناميكي) -->
            <div class="mb-32 text-center text-center text-center text-center text-center">
                <h3 class="text-2xl font-black italic text-brand uppercase mb-10 text-center text-center text-center">اختبارات رياضيين</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center text-center text-center text-center text-center">
                    <?php
                    // جلب التقييمات من قاعدة البيانات
                    $evaluations = get_posts([
                        'post_type' => 'evaluation',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ]);
                    
                    if ($evaluations) :
                        foreach ($evaluations as $evaluation) :
                            $eval_image = get_the_post_thumbnail_url($evaluation->ID, 'large');
                            if (!$eval_image) {
                                $eval_image = 'https://images.unsplash.com/photo-1599447421416-3414500d18a5?q=80&w=600';
                            }
                            $eval_type = get_post_meta($evaluation->ID, '_evaluation_type', true);
                            if (!$eval_type) {
                                $eval_type = 'اختبار رياضي';
                            }
                    ?>
                    <div class="rounded-[2rem] overflow-hidden relative group aspect-video border border-brand/20 shadow-lg shadow-brand/5 text-center">
                        <img src="<?php echo esc_url($eval_image); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700 brightness-50" alt="<?php echo esc_attr($evaluation->post_title); ?>">
                        <div class="absolute inset-0 flex items-center justify-center text-center text-center">
                            <div class="w-12 h-12 bg-brand/80 rounded-full flex items-center justify-center shadow-lg text-center text-center">
                                <i data-lucide="play" class="text-dark w-5 h-5 fill-dark ml-1 text-center"></i>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-4 text-right text-center">
                            <p class="text-[8px] font-black uppercase text-brand italic text-center"><?php echo esc_html($eval_type); ?></p>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <div class="col-span-3 text-center text-white/40">
                        <p>لا توجد تقييمات حالياً</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- باقة الاختبارات (ديناميكية) -->
            <?php
            $premium_packages = new WP_Query([
                'post_type' => 'package',
                'posts_per_page' => 1,
                'meta_query' => [
                    [
                        'key' => '_package_style',
                        'value' => 'premium',
                    ]
                ]
            ]);

            if ($premium_packages->have_posts()) :
                while ($premium_packages->have_posts()) : $premium_packages->the_post();
                    $p_id = get_the_ID();
                    $p_subtitle = get_post_meta($p_id, '_package_subtitle', true);
                    $p_price = get_post_meta($p_id, '_package_price', true);
                    $p_currency = get_post_meta($p_id, '_package_currency', true) ?: 'ريال';
                    $p_button = get_post_meta($p_id, '_package_button_text', true) ?: 'احجز موعد التقييم الآن';
                    $p_features_raw = get_post_meta($p_id, '_package_features', true);
                    $p_features = explode("\n", str_replace("\r", "", $p_features_raw));
            ?>
            <div class="max-w-xl mx-auto bg-surface p-12 rounded-[3rem] border border-brand/30 text-center shadow-2xl text-center text-center">
                <div class="mb-10 text-center text-center">
                    <h4 class="text-2xl font-black italic mb-4 uppercase text-center text-center"><?php the_title(); ?></h4>
                    <div class="mb-8 text-center text-center text-center">
                        <span class="text-6xl font-black italic text-brand text-center text-center text-center"><?php echo esc_html($p_price); ?></span> 
                        <span class="text-sm font-bold opacity-40 uppercase text-center"><?php echo esc_html($p_currency); ?> / <?php echo esc_html($p_subtitle); ?></span>
                    </div>
                    <ul class="space-y-5 text-xs font-bold opacity-80 text-center text-center">
                        <?php foreach ($p_features as $f) : if (trim($f)) : ?>
                        <li class="flex items-center justify-center gap-3 text-center text-center text-center">
                            <i data-lucide="check-circle" class="text-brand w-4 h-4 shrink-0 text-center text-center"></i> 
                            <span><?php echo esc_html(trim($f)); ?></span>
                        </li>
                        <?php endif; endforeach; ?>
                    </ul>
                </div>
                <a href="<?php echo bandar_get_whatsapp_url(); ?>" class="block w-full py-5 gold-gradient text-dark rounded-xl font-black text-lg italic uppercase hover:scale-105 transition-all text-center shadow-lg shadow-brand/20"><?php echo esc_html($p_button); ?></a>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
            <!-- باقة افتراضية -->
            <div class="max-w-xl mx-auto bg-surface p-12 rounded-[3rem] border border-brand/30 text-center shadow-2xl text-center text-center">
                <div class="mb-10 text-center text-center">
                    <h4 class="text-2xl font-black italic mb-4 uppercase text-center text-center">باقة الاختبارات الاحترافية</h4>
                    <div class="mb-8 text-center text-center text-center"><span class="text-6xl font-black italic text-brand text-center text-center text-center">499</span> <span class="text-sm font-bold opacity-40 uppercase text-center">ريال / تقييم</span></div>
                    <ul class="space-y-5 text-xs font-bold opacity-80 text-center text-center">
                        <li class="flex items-center justify-center gap-3 text-center text-center text-center"><i data-lucide="check-circle" class="text-brand w-4 h-4 shrink-0 text-center text-center"></i> <span>التقييمات البدنية الشاملة لجميع الوظائف الحركية</span></li>
                        <li class="flex items-center justify-center gap-3 text-center text-center text-center text-center"><i data-lucide="check-circle" class="text-brand w-4 h-4 shrink-0 text-center text-center"></i> <span>تقرير تقني مفصل (PDF) جاهز للتقديم للأندية</span></li>
                    </ul>
                </div>
                <button class="w-full py-5 gold-gradient text-dark rounded-xl font-black text-lg italic uppercase hover:scale-105 transition-all text-center shadow-lg shadow-brand/20">احجز موعد التقييم الآن</button>
            </div>
            <?php endif; ?>
        </section>

    </main>

    <!-- Footer -->
    <?php get_template_part('template-parts/footer', 'main'); ?>
    <?php wp_footer(); ?>

    <script>
        lucide.createIcons();

        function showView(viewId) {
            const homeView = document.getElementById('homeView');
            const mainHeader = document.getElementById('mainHeader');
            homeView.style.opacity = '0';
            setTimeout(() => {
                homeView.style.display = 'none';
                const targetView = document.getElementById(viewId);
                targetView.classList.add('active');
                document.getElementById('backNav').classList.remove('hidden');
                mainHeader.classList.add('bg-dark/95', 'backdrop-blur-xl');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 600);
        }

        function showHome() {
            const homeView = document.getElementById('homeView');
            const mainHeader = document.getElementById('mainHeader');
            document.querySelectorAll('.view-content').forEach(view => view.classList.remove('active'));
            document.getElementById('backNav').classList.add('hidden');
            mainHeader.classList.remove('bg-dark/95', 'backdrop-blur-xl');
            homeView.style.display = 'flex';
            setTimeout(() => homeView.style.opacity = '1', 50);
        }

        // Music toggle functionality
        document.getElementById('musicToggle').addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon.getAttribute('data-lucide') === 'music-2') {
                icon.setAttribute('data-lucide', 'music');
                lucide.createIcons();
            } else {
                icon.setAttribute('data-lucide', 'music-2');
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>
