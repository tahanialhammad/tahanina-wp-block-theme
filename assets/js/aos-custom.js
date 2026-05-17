document.addEventListener('DOMContentLoaded', function() {
    // البحث عن العناصر التي تحتوي على كلاسات AOS
    var animatedElements = document.querySelectorAll('[class*="aos-"]');
    
    animatedElements.forEach(function(element) {
        element.classList.forEach(function(className) {
            
            // تحويل كلاس الحركة (مثال: aos-fade-up -> data-aos='fade-up')
            if (className.startsWith('aos-') && !className.startsWith('aos-delay-')) {
                var animationName = className.replace('aos-', '');
                element.setAttribute('data-aos', animationName);
            }
            
            // تحويل كلاس التأخير (مثال: aos-delay-200 -> data-aos-delay='200')
            if (className.startsWith('aos-delay-')) {
                var delayValue = className.replace('aos-delay-', '');
                element.setAttribute('data-aos-delay', delayValue);
            }
        });
    });

    // تشغيل المكتبة بالإعدادات الافتراضية
    AOS.init({
        offset: 120,
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });
});