 SELECT r.so_number,
        COUNT(v.so_number),
        r.position_title, 
        r.date_submitted, 
        r.num_resource_need, 
        r.cgi_engage_manager, 
        r.rate_crd_cat_lvl, 
        r.RM_ID, 
        r.status 
        FROM rmemform AS r
        LEFT JOIN vendor AS v ON r.so_number = v.so_number
        GROUP BY r.RM_ID;


"SELECT r.so_number,
COUNT(v.so_number) AS v_num,
r.position_title, 
r.date_submitted, 
r.num_resource_need, 
r.cgi_engage_manager, 
r.rate_crd_cat_lvl, 
r.RM_ID, 
r.status 
FROM ("SELECT r.so_number,
COUNT(v.so_number) AS v_num,
r.position_title, 
r.date_submitted, 
r.num_resource_need, 
r.cgi_engage_manager, 
r.rate_crd_cat_lvl, 
r.RM_ID, 
r.status 
FROM rmemform AS r
LEFT JOIN users AS u ON r.user_id = u.user_id
GROUP BY r.RM_ID" )
LEFT JOIN vendor AS v ON r.so_number = v.so_number,
GROUP BY r.RM_ID";   