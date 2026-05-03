const body = document.body;
const root = document.documentElement;
const header = document.querySelector('.site-header');
const menuToggle = document.getElementById('menuToggle');
const mobilePanel = document.getElementById('mobilePanel');
const cursorRing = document.querySelector('.cursor-ring');
const cursorCore = document.querySelector('.cursor-core');
const glow = document.querySelector('.cursor-glow');
const trailNodes = Array.from(document.querySelectorAll('.cursor-trails span'));
const form = document.getElementById('contactForm');
const isDesktopPointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

const updateHeaderState = () => {
  const atTop = window.scrollY <= 8;
  header?.classList.toggle('at-top', atTop);
  header?.classList.toggle('scrolled', !atTop);
};
window.addEventListener('scroll', updateHeaderState, { passive: true });
window.addEventListener('resize', updateHeaderState);
updateHeaderState();

menuToggle?.addEventListener('click', () => {
  const open = body.classList.toggle('nav-open');
  menuToggle.setAttribute('aria-expanded', String(open));
});

mobilePanel?.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
  body.classList.remove('nav-open');
  menuToggle?.setAttribute('aria-expanded', 'false');
}));

document.querySelectorAll('.dropdown-toggle').forEach(button => {
  button.addEventListener('click', (event) => {
    event.preventDefault();
    event.stopPropagation();
    const dropdown = button.closest('.nav-dropdown');
    document.querySelectorAll('.nav-dropdown.open').forEach(item => {
      if (item !== dropdown) item.classList.remove('open');
    });
    dropdown?.classList.toggle('open');
  });
});

document.addEventListener('click', (event) => {
  if (!event.target.closest('.nav-dropdown')) {
    document.querySelectorAll('.nav-dropdown.open').forEach(drop => drop.classList.remove('open'));
  }
});

window.addEventListener('scroll', () => {
  document.querySelectorAll('.nav-dropdown.open').forEach(drop => drop.classList.remove('open'));
}, { passive: true });

const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });

document.querySelectorAll('.reveal').forEach((el, i) => {
  el.style.transitionDelay = `${Math.min(i % 10, 9) * 36}ms`;
  revealObserver.observe(el);
});

let mouse = { x: window.innerWidth * 0.5, y: window.innerHeight * 0.35 };
let ring = { x: mouse.x, y: mouse.y };
let glowPos = { x: mouse.x, y: mouse.y };
let trail = trailNodes.map((_, i) => ({ x: mouse.x, y: mouse.y, ease: 0.2 - i * 0.045 }));
let cursorFrame = null;

const moveCursor = (x, y) => {
  mouse.x = x;
  mouse.y = y;
  root.style.setProperty('--mx', `${x}px`);
  root.style.setProperty('--my', `${y}px`);
  root.style.setProperty('--mouse-x', `${x}px`);
  root.style.setProperty('--mouse-y', `${y}px`);
};

if (isDesktopPointer) {
  document.documentElement.classList.add('has-custom-cursor');

  window.addEventListener('pointermove', (event) => moveCursor(event.clientX, event.clientY), { passive: true });
  window.addEventListener('pointerdown', () => {
    cursorRing?.classList.add('cursor-down');
    cursorCore?.classList.add('cursor-down');
  });
  window.addEventListener('pointerup', () => {
    cursorRing?.classList.remove('cursor-down');
    cursorCore?.classList.remove('cursor-down');
  });

  const animateCursor = () => {
    ring.x += (mouse.x - ring.x) * 0.22;
    ring.y += (mouse.y - ring.y) * 0.22;
    glowPos.x += (mouse.x - glowPos.x) * 0.08;
    glowPos.y += (mouse.y - glowPos.y) * 0.08;

    if (cursorRing) {
      cursorRing.style.left = `${ring.x}px`;
      cursorRing.style.top = `${ring.y}px`;
    }
    if (cursorCore) {
      cursorCore.style.left = `${mouse.x}px`;
      cursorCore.style.top = `${mouse.y}px`;
    }
    if (glow) {
      glow.style.left = `${glowPos.x}px`;
      glow.style.top = `${glowPos.y}px`;
    }

    trail.forEach((point, i) => {
      const previous = i === 0 ? mouse : trail[i - 1];
      point.x += (previous.x - point.x) * point.ease;
      point.y += (previous.y - point.y) * point.ease;
      const node = trailNodes[i];
      if (node) {
        node.style.left = `${point.x}px`;
        node.style.top = `${point.y}px`;
        node.style.opacity = `${0.5 - i * 0.14}`;
      }
    });

    cursorFrame = requestAnimationFrame(animateCursor);
  };
  cursorFrame = requestAnimationFrame(animateCursor);

  document.querySelectorAll('a, button, input, select, textarea, .flash-card, .service-card, .project-card, .showcase-card, .advantage-card').forEach(el => {
    el.addEventListener('mouseenter', () => {
      cursorRing?.classList.add('cursor-hover');
      cursorCore?.classList.add('cursor-hover');
    });
    el.addEventListener('mouseleave', () => {
      cursorRing?.classList.remove('cursor-hover');
      cursorCore?.classList.remove('cursor-hover');
    });
  });
}

const flashSelectors = [
  '.flash-card', '.service-card', '.project-card', '.detail-card', '.solution-card',
  '.story-card', '.showcase-card', '.industry-card', '.value-card', '.mission-card',
  '.feature-pill', '.seo-card', '.cta-card', '.about-card', '.solution-visual', '.main-visual', '.contact-panel', '.advantage-card'
].join(',');

const resetFlashCard = (card) => {
  if (!card) return;
  card.classList.remove('flash-active');
  card.style.transform = '';
  card.style.boxShadow = '';
  card.style.setProperty('--px', '50%');
  card.style.setProperty('--py', '50%');
  card.style.setProperty('--fx', '0px');
  card.style.setProperty('--fy', '0px');
  Array.from(card.children).forEach(child => child.style.transform = '');
};

const applyFlashCard = (card, event) => {
  if (!isDesktopPointer) return;
  if (card.matches('[data-pin-card], [data-story-card]') && !card.classList.contains('is-active')) return;

  const rect = card.getBoundingClientRect();
  const px = Math.min(Math.max((event.clientX - rect.left) / rect.width, 0), 1);
  const py = Math.min(Math.max((event.clientY - rect.top) / rect.height, 0), 1);
  const rotateX = (0.5 - py) * 13;
  const rotateY = (px - 0.5) * 15;
  const focusX = (px - 0.5) * 18;
  const focusY = (py - 0.5) * 14;

  card.classList.add('flash-active');
  card.style.setProperty('--px', `${px * 100}%`);
  card.style.setProperty('--py', `${py * 100}%`);
  card.style.setProperty('--fx', `${focusX}px`);
  card.style.setProperty('--fy', `${focusY}px`);
  card.style.transform = `perspective(1400px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translate3d(0,-8px,0) scale(1.012)`;
  card.style.boxShadow = `${-rotateY * 1.05}px ${24 + Math.abs(rotateX) * 1.1}px 54px rgba(17,24,39,.18)`;

  Array.from(card.children).forEach((child, idx) => {
    const depth = Math.max(8, 28 - idx * 2.2);
    child.style.transform = `translate3d(${focusX * 0.16}px, ${focusY * 0.12}px, ${depth}px)`;
  });
};

document.querySelectorAll(flashSelectors).forEach(card => {
  card.addEventListener('pointermove', (event) => applyFlashCard(card, event));
  card.addEventListener('pointerleave', () => resetFlashCard(card));
  card.addEventListener('blur', () => resetFlashCard(card));
});

document.querySelectorAll('.nav-link').forEach(link => {
  link.addEventListener('pointermove', (event) => {
    const rect = link.getBoundingClientRect();
    link.style.setProperty('--nx', `${((event.clientX - rect.left) / rect.width) * 100}%`);
  });
});

const updatePinShowcase = (track) => {
  const cards = Array.from(track.querySelectorAll('[data-pin-card]'));
  if (!cards.length || window.innerWidth <= 640) return;

  const navButtons = Array.from(track.querySelectorAll('[data-pin-nav] button'));
  const progress = track.querySelector('[data-pin-progress]');
  const rect = track.getBoundingClientRect();
  const total = Math.max(1, rect.height - window.innerHeight);
  const raw = Math.min(Math.max(-rect.top / total, 0), 1);
  const index = Math.min(cards.length - 1, Math.floor(raw * cards.length));

  cards.forEach((card, i) => {
    card.classList.remove('is-active', 'is-prev', 'is-next');
    resetFlashCard(card);
    if (i === index) card.classList.add('is-active');
    if (i === index - 1) card.classList.add('is-prev');
    if (i === index + 1) card.classList.add('is-next');
  });

  navButtons.forEach((button, i) => button.classList.toggle('active', i === index));
  if (progress) progress.style.width = `${Math.max(8, ((index + 1) / cards.length) * 100)}%`;
};

const pinTracks = Array.from(document.querySelectorAll('[data-pin-showcase]'));
pinTracks.forEach(track => {
  const cards = Array.from(track.querySelectorAll('[data-pin-card]'));
  track.style.height = `${Math.max(260, cards.length * 58)}vh`;

  Array.from(track.querySelectorAll('[data-pin-nav] button')).forEach((button, index) => {
    button.addEventListener('click', () => {
      const trackTop = window.scrollY + track.getBoundingClientRect().top;
      const available = track.offsetHeight - window.innerHeight;
      const target = trackTop + available * (index / Math.max(cards.length - 1, 1));
      window.scrollTo({ top: target, behavior: 'smooth' });
    });
  });
});

const updateAllPinned = () => pinTracks.forEach(updatePinShowcase);
window.addEventListener('scroll', updateAllPinned, { passive: true });
window.addEventListener('resize', updateAllPinned);
updateAllPinned();

const storyTrack = document.querySelector('[data-scroll-story]');
const storyCards = Array.from(document.querySelectorAll('[data-story-card]'));
const storyProgress = document.querySelector('[data-progress-fill]');

const updateStoryScroll = () => {
  if (!storyTrack || !storyCards.length || window.innerWidth <= 640) return;

  const rect = storyTrack.getBoundingClientRect();
  const total = Math.max(1, rect.height - window.innerHeight);
  const raw = Math.min(Math.max(-rect.top / total, 0), 1);
  const index = Math.min(storyCards.length - 1, Math.floor(raw * storyCards.length));

  storyCards.forEach((card, i) => {
    card.classList.remove('is-active', 'is-prev', 'is-next');
    resetFlashCard(card);
    if (i === index) card.classList.add('is-active');
    if (i === index - 1) card.classList.add('is-prev');
    if (i === index + 1) card.classList.add('is-next');
  });

  if (storyProgress) storyProgress.style.width = `${Math.max(20, raw * 100)}%`;
};

window.addEventListener('scroll', updateStoryScroll, { passive: true });
window.addEventListener('resize', updateStoryScroll);
updateStoryScroll();

form?.addEventListener('submit', () => {
  const note = document.getElementById('formNote');
  if (note) note.textContent = 'Submitting your enquiry...';
});


// v8: delegated, full-surface flash-card interaction. Native cursor remains visible.
(function(){
  const fine = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  const selector = '.flash-card,.service-card,.project-card,.detail-card,.solution-card,.story-card,.showcase-card,.industry-card,.value-card,.mission-card,.feature-pill,.seo-card,.cta-card,.about-card,.solution-visual,.main-visual,.contact-panel,.contact-form,.advantage-card,.faq-item';
  let active = null;
  function clear(card){
    if(!card) return;
    card.classList.remove('flash-active');
    card.style.transform = '';
    card.style.boxShadow = '';
    card.style.setProperty('--px','50%');
    card.style.setProperty('--py','50%');
    Array.from(card.children).forEach(child => child.style.transform = '');
  }
  function apply(card, e){
    if(!fine || !card) return;
    if(card.matches('[data-pin-card], [data-story-card]') && !card.classList.contains('is-active')) return;
    const r = card.getBoundingClientRect();
    if(!r.width || !r.height) return;
    const x = Math.max(0, Math.min(1, (e.clientX - r.left) / r.width));
    const y = Math.max(0, Math.min(1, (e.clientY - r.top) / r.height));
    const rx = (0.5 - y) * 10;
    const ry = (x - 0.5) * 12;
    card.classList.add('flash-active');
    card.style.setProperty('--px', (x * 100) + '%');
    card.style.setProperty('--py', (y * 100) + '%');
    card.style.transform = `perspective(1200px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-6px)`;
    card.style.boxShadow = `${-ry}px ${24 + Math.abs(rx)}px 70px rgba(0,0,0,.38)`;
    Array.from(card.children).forEach((child, i) => {
      const depth = Math.max(7, 22 - i * 1.5);
      child.style.transform = `translate3d(${(x-.5)*7}px, ${(y-.5)*6}px, ${depth}px)`;
    });
  }
  document.addEventListener('pointermove', function(e){
    document.documentElement.style.setProperty('--mx', e.clientX + 'px');
    document.documentElement.style.setProperty('--my', e.clientY + 'px');
    document.documentElement.style.setProperty('--mouse-x', e.clientX + 'px');
    document.documentElement.style.setProperty('--mouse-y', e.clientY + 'px');
    const card = e.target.closest(selector);
    if(card !== active){ clear(active); active = card; }
    apply(card, e);
  }, {passive:true});
  document.addEventListener('pointerleave', function(){ clear(active); active=null; });
  document.addEventListener('scroll', function(){ clear(active); active=null; }, {passive:true});
})();
