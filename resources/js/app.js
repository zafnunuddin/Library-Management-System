// app.js

const express = require('express');
const app = express();

// ইমপোর্টসমূহ
const pageRoutes = require('./routes/pageRoutes');   // পাবলিক API রাউট
const adminRoutes = require('./routes/adminRoutes'); // অ্যাডমিন রাউটসমূহ

// মিডলওয়্যার
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// ১. পাবলিক রাউট সেটআপ (যেমন: /api/page/terms)
app.use('/api', pageRoutes); 

// ২. অ্যাডমিন রাউট সেটআপ (যেমন: /admin/edit-legal/terms)
// এখন এই রাউটের মাধ্যমে আপনি /admin/edit-legal/:slug এবং /admin/update-legal ব্যবহার করতে পারবেন
app.use('/admin', adminRoutes); 

// সার্ভার স্টার্ট
const PORT = 5000;
app.listen(PORT, () => {
    console.log(`Server is running on port http://localhost:${PORT}`);
});