import './bootstrap';
import AOS from 'aos';
import 'aos/dist/aos.css';
import Alpine from 'alpinejs';
import 'flowbite';

window.Alpine = Alpine;

AOS.init({
    once: true,     
    duration: 1500,   
    delay: 300,        
    easing: 'ease-in-out', 
  });
Alpine.start();



