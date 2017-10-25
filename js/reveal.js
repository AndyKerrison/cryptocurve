window.sr = ScrollReveal({ reset:false, viewFactor  : 0.4,
                    easing:'cubic-bezier(0.560, 0.005, 0.225, 1.150)'
                         });


sr.reveal('#bat',{
  origin: 'top',
  distance: '10rem',
  duration: 900,
});

sr.reveal('#stratis',{
  origin: 'bottom',
  distance: '10rem',
  duration: 900,
  
});

sr.reveal('#go',{
  duration: 750,
  origin:'right',
  distance: '10rem',
  viewOffset  : {bottom: 189},
  delay:0,
});

sr.reveal('#augur',{
  duration: 750,
  origin:'right',
  distance: '0rem',
  viewOffset  : {bottom: 189},
  delay:0,
});