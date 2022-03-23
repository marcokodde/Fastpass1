/** Consulta General */
SELECT sv.id,cl.id,cl.client_id,cl.downpayment,cl.loggin_times,
       cs.expire_at,cs.token,cs.has_been_used,
		 de.name,de.percentage,
		 inv.stock,inv.vin,inv.make,inv.model,inv.retail_price,
		 sv.sale_price,sv.grade,sv.downpayment_for_next_tier
FROM clients cl,client_sessions cs,dealers de,inventories inv,suggested_vehicles sv
WHERE cl.id =cs.client_id
  AND cl.id = sv.client_id
  AND de.id = sv.dealer_id
  AND inv.id = sv.inventory_id
  AND cl.id  = 2
 -- AND inv.id = 627
 -- AND downpayment_for_next_tier
ORDER BY sv.sale_price
