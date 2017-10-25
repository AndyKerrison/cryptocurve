const tickerUrl = "https://api.coinmarketcap.com/v1/ticker/";

let priceEl;

window.onload = () => {
  priceEl = document.querySelector(".bat-price");
  update();
  setInterval(update, 5000);
};

const update = () => {
  getBatPrice().then(price => (priceEl.textContent = formatUsd(price)));
};

const getBatPrice = () =>
  new Promise((resolve, _) =>
    fetch(tickerUrl)
      .then(res => res.json())
      .then(data => resolve(data.find(e => e.id === "basic-attention-token").price_usd))
  );

const formatUsd = value => {
  return `$${value}`;
};