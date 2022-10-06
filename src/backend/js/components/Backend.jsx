export const ajaxurl = awesomecoder.ajaxurl;
export const post_types = awesomecoder.post_types;
export const users = awesomecoder.users;
export const headers = {
  headers: {
      'X-Requested-With': 'XMLHttpRequest',
      "Content-type": "multipart/form-data",
      // "Keep-Alive": "timeout=5, max=1000",
  }
};

export default {
    awesomecoder,
    ajaxurl,
    post_types,
    users,
}