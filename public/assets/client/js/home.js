// throttle
const throttle = (fn, time) => {
   let delay = time || 0;
   let last = 0;
   return (...args) => {
      let now = new Date().getTime();
      if (now - last < delay) return;
      fn.apply(this, args); 
      last = now;
   };
};
