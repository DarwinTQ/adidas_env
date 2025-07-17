<?php
// Archivo: app/models/Pedido.php

class Pedido {
    public ?int $id_pedido;
    public int $id_cliente;
    public string $fecha_pedido;
    public string $direccion_envio;
    public float $monto_total;
    public $cliente_nombre; // Propiedad para el nombre del cliente

    /**
     * Obtiene todos los pedidos usando OCI8
     * @return array
     */
    public static function todos() {
        $db = new DatabaseConnection();
        $conn = $db->getConnection();

        $sql = "
            SELECT p.id_pedido, p.fecha_pedido, p.direccion_envio, p.monto_total, c.nombre as cliente_nombre
            FROM Pedidos p
            JOIN Clientes c ON p.id_cliente = c.id_cliente
            ORDER BY p.fecha_pedido DESC
        ";

        $stmt = oci_parse($conn, $sql);
        oci_execute($stmt);

        $pedidos = [];
        // oci_fetch_assoc() devuelve las columnas en mayúsculas por defecto en Oracle
        while ($row = oci_fetch_assoc($stmt)) {
            $pedido = new Pedido();
            $pedido->id_pedido = $row['ID_PEDIDO'];
            $pedido->fecha_pedido = $row['FECHA_PEDIDO'];
            $pedido->direccion_envio = $row['DIRECCION_ENVIO'];
            $pedido->monto_total = $row['MONTO_TOTAL'];
            $pedido->cliente_nombre = $row['CLIENTE_NOMBRE'];
            $pedidos[] = $pedido;
        }

        oci_free_statement($stmt);
        $db->closeConnection();

        return $pedidos;
    }
}