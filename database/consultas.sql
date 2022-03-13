/** Consulta General */

SELECT cl.client_id,cl.downpayment,cl.loggin_times,
       cs.expire_at,cs.token,
		 de.name,de.percentage,
		 inv.stock,inv.vin,inv.make,inv.model,
		 sv.sale_price,sv.grade,sv.downpayment_for_next_tier
FROM clients cl,client_sessions cs,dealers de,inventories inv,suggested_vehicles sv
WHERE cl.id =cs.client_id
  AND cl.id = sv.client_id
  AND de.id = sv.dealer_id
  AND inv.id = sv.inventory_id
