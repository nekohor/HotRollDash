import request from '@/utils/request';

export function calcYield(data) {
  return request({
    url: '/production/yield/shift',
    method: 'post',
    data,
  });
}
