# Stock Management System (Core PHP + MySQL)

A complete invoice-based Stock Management System built with Core PHP (OOP) and MySQL. The system handles sales, purchases, returns, stock adjustments, and reporting with stock movement logs.

## Features
- Product & stock management with minimum stock alerts
- Invoice-based stock logic (sales & purchase)
- Sales/purchase returns with audit trail
- Stock adjustment module with reason tracking
- Dashboard KPIs
- Customer & supplier management
- Role-based login (Admin / Staff)
- Reports with CSV export
- Print/PDF-friendly invoices (browser print)

## Tech Stack
- PHP 8+
- MySQL 5.7+ / 8+
- Bootstrap 5

## Installation
1. **Clone or copy** the project into your web root.
2. **Create database and tables**:
   ```bash
   mysql -u root -p < database/schema.sql
   ```
3. **Update DB credentials** in `config/config.php`.
4. **Start the PHP server** (dev mode):
   ```bash
   php -S localhost:8000 -t public
   ```
5. Open `http://localhost:8000`.

## Sample Login
- **Email:** admin@example.com
- **Password:** admin123

## Notes on Business Logic
- Stock is never edited directly; only via sales/purchase, returns, or adjustments.
- Negative stock is blocked on sales invoice creation.
- Every stock change is logged in `stock_movements`.

## Expansion Ready
The codebase is structured in a simple MVC style and can be extended for:
- POS module
- Barcode scanning
- Multi-warehouse inventory

## Directory Structure
```
app/
  Controllers/
  Core/
  Models/
  Views/
config/
database/
public/
```
