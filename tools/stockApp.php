<div class="container mt-5">
    <h1 class="mb-4">Aktien Portfolio Tracker</h1>

    <form id="portfolioForm">
        <div class="form-group">
            <label for="symbol">Aktien Symbol:</label>
            <input type="text" class="form-control" name="symbol" id="symbol" required>
        </div>
        <div class="form-group">
            <label for="quantity">Die Menge:</label>
            <input type="number" class="form-control" name="quantity" id="quantity" required>
        </div>
        <br>
        <button type="button" class="btn btn-primary" id="addStockButton">Aktie Hinzufügen</button>
    </form>

    <div id="portfolioList" class="mt-4">
    </div>
</div>

<script>
    document.getElementById('addStockButton').addEventListener('click', function() {
        fetchStockData();
    });

    function fetchStockData() {
        const symbol = document.getElementById('symbol').value;
        const quantity = parseInt(document.getElementById('quantity').value);
        const portfolioList = document.getElementById('portfolioList');
        fetch(`tools/stockApp/getStockData.php?symbol=${symbol}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }

                const stockPrice = parseFloat(data.stockPrice);
                const totalValue = stockPrice * quantity;

                const stockItem = document.createElement('div');
                stockItem.className = 'stock-item';
                stockItem.innerHTML = `<p>
                <strong class="text-primary">${symbol}</strong> -
                <strong>Anzahl:</strong> ${quantity} -
                <strong>Preis:</strong> $${stockPrice.toFixed(2)} -
                <strong>Summe:</strong> $${totalValue.toFixed(2)}
                </p>`;
                portfolioList.appendChild(stockItem);
            })
            .catch(error => {
                console.error('Fehler beim Abrufen der Aktiendaten:', error);
                alert('Fehler beim Abrufen der Aktiendaten. Bitte versuchen Sie es später erneut.');
            });
    }
</script>
