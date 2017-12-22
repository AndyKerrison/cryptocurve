window.sr = ScrollReveal({ reset:false, viewFactor  : 0.4,
                    easing:'cubic-bezier(0.560, 0.005, 0.225, 1.150)'
                         });


sr.reveal('#pic1',{
  origin: 'top',
  distance: '10rem',
  duration: 900,
});

sr.reveal('#pic2',{
  origin: 'bottom',
  distance: '10rem',
  duration: 900,
  
});

sr.reveal('#pic3',{
  duration: 900,
  origin:'left',
  distance: '10rem',
  viewOffset  : {bottom: 189},
  delay:0,
});

sr.reveal('#pic4',{
  duration: 900,
  origin:'right',
  distance: '10rem',
  viewOffset  : {bottom: 189},
  delay:0,
});

sr.reveal('#pic5',{
  duration: 900,
  origin:'bottom',
  distance: '10rem',
  viewOffset  : {bottom: 189},
  delay:0,
});

sr.reveal('.phone-container',{
  origin: 'bottom',
  distance: '10rem',
  duration: 900,
});


sr.reveal('.phone-layer1',{
  origin: 'left',
  distance: '10rem',
  duration: 900,
  delay:500,
});

sr.reveal('.phone-layer2',{
  origin: 'left',
  distance: '10rem',
  duration: 900,
});

sr.reveal('.fiat-info',{
  origin: 'top',
  distance: '10rem',
  duration: 1200,
});

sr.reveal('.fiat-image-container',{
  origin: 'bottom',
  distance: '10rem',
  duration: 1200,
});