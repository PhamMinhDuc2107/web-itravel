// throttle
const throttle = (fn, time) => {
   let delay = time || 0;
   let last = 0;
   return (...args) => {
      let now = new Date().getTime();
      if (now - last < delay) return;
      last = now;
      fn(...args)
   };
};
// debounce 
const debounce = (fn,time) => {
   let delay = time || 0;
   let timeId;
   return (...args) => {
      if(timeId) {
         clearTimeout(timeId)
         timeId= null;
      }
      timeId = setTimeout((...args) => {
         fn(...args)
      },delay)
   }
}
