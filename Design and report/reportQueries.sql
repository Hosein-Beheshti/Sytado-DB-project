SELECT SUM(totalPrice) as value_sum
FROM order_factor
where customer_id = $customer_id;

SELECT food , MAX(c) as max
from (select list.food as food , COUNT(*) as c
from food_list as list , order_factor as factor
where list.factor_id = factor.factor_id and factor.customer_id = 1
GROUP BY list.food) as tbl;

SELECT SUM(totalPrice) as value_sum
FROM order_factor
where date = '2018-01-11';

SELECT list.food as food , list.price as price
from order_factor as factor , food_list as list
where factor.factor_id = list.factor_id and factor.date = '2018-01-11';

SELECT SUM(totalPrice) as value_sum
FROM material_factor
where date = '2018-01-11';

SELECT list.material as material , list.price as price
from material_factor as factor , material_list as list
where factor.material_factor_id = list.material_factor_id and factor.date = '2018-01-11';
            